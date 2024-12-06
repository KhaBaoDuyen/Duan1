<?php

namespace App\Models;

class ContactModel extends BaseModel
{
    protected $table = 'contact';
    protected $id = 'id';

    public function getAllContact()
    {
        return $this->getAll();
    }
    public function getOneContact($id)
    {
        return $this->getOne($id);
    }

    public function createContact($data)
    {
        return $this->create($data);
    }
    public function updateContact($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteContact($id)
    {
        return $this->delete($id);
    }
    
    

}
