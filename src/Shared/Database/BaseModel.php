<?php

namespace App\Shared\Database;

abstract class BaseModel
{
    private DatabaseDriverInterface $databaseDriver;

    protected \PDO $connection;

    /**
     * @var array<int,string>
     */
    protected array $columns = [];

    protected string $table;

    public function __construct()
    {
        $this->databaseDriver = new MySQLDriver();

        $this->connection = $this->databaseDriver->getConnection();
    }

    public function paginate(
        int    $page = 1,
        int    $perPage = 10,
        string $select = 'SELECT *',
        string $where = '',
        string $join = '',
        string $order = 'ORDER BY id',
        array  $params = []
    ): \stdClass
    {
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $perPage;

        $totalPages = (int)ceil($this->count($where, $params) / $perPage);

        $stmt = $this->connection->prepare("$select FROM `{$this->table}` $join $where $order LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return (object)[
            'records' => $stmt->fetchAll(),
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];

    }

    public function count(string $where = '', array $params = []): int
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) FROM `{$this->table}` {$where}");

        $statement->execute($params);

        return (int)$statement->fetchColumn();

    }

    public function findBy(string $column, $value): ?\stdClass
    {
        if (!in_array($column, $this->columns)) return null;

        $statement = $this->connection->prepare("SELECT * FROM `{$this->table}` WHERE `{$column}` = :value LIMIT 1");

        $statement->execute(compact('value'));

        return $statement->fetchObject() ?: null;

    }

    public function create(array $data): ?\stdClass
    {
        $allowedData = $this->getAvailableColumnsFromArray($data);

        if (empty($allowedData)) return null;

        $columns = implode('`, `', array_keys($allowedData));
        $values = implode(', :', array_keys($allowedData));

        $statement = $this->connection
            ->prepare("INSERT INTO `{$this->table}` (`{$columns}`) VALUES (:{$values})");

        $statement->execute($allowedData);

        return $this->findBy('id', $this->connection->lastInsertId());
    }

    public function update($id, array $data): ?\stdClass
    {
        $allowedData = $this->getAvailableColumnsFromArray($data);

        if (empty($allowedData)) return null;

        $values = implode(
            ', ',
            array_map(
                fn($column) => "`$column` = :$column",
                array_keys($allowedData)
            )
        );

        $statement = $this->connection
            ->prepare("UPDATE `{$this->table}` SET {$values} WHERE id = :id");

        $allowedData['id'] = $id;

        $statement->execute($allowedData);

        return $this->findBy('id', $id);
    }

    public function delete($id): bool
    {
        $statement = $this->connection->prepare("DELETE FROM `{$this->table}` WHERE id = :id");

        return $statement->execute(['id' => $id]);
    }

    public function get(
        ?string $select = 'SELECT *',
        ?string $where = '',
        ?string $join = '',
        ?string $order = 'ORDER BY id DESC',
        ?array  $params = []
    ): array
    {
        $stmt = $this->connection->prepare("$select FROM `{$this->table}` {$join} $where $order");

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    private function getAvailableColumnsFromArray(array $data): array
    {
        return array_intersect_key($data, array_flip($this->columns));
    }
}