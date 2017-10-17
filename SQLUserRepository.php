<?php
class SQLUserRepository implements UserRepositoryInterface
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        // Find a record with the id = $id
        // from the 'users' table
        // and return it as a User object
        return $this->db->find($id, 'Customers', 'customer');
    }

    public function save(Customer $customer)
    {
        // Insert or update the $customer
        // in the 'customers' table
        $this->db->save($customer, 'Customers');
    }

    public function remove(Customer $customer)
    {
        // Remove the $customer
        // from the 'Customers' table
        $this->db->remove($customer, 'Customers');
    }
}
