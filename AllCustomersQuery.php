<?php
interface AllCustomersQueryInterface
{
    public function fetch($fields);
}

class AllCustomersQuery implements AllCustomersQueryInterface
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function fetch($fields)
    {
        return $this->db->select($fields)->from('Customers')->orderBy('Lname, Fname')->rows();
    }
}
