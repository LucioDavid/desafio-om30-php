<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table;
    protected $primaryKey;

    protected $timestamps = TRUE;
    protected $timestampsFormat = 'Y-m-d H:i:s';

    private $_createdAtField;
    private $_updatedAtField;

    public function __construct()
    {
        parent::__construct();
        $this->_setTimestamps();
    }

    public function findAll()
    {
        return $this->db->select("*")->from($this->table)->result_array();
    }

    public function findById($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table);
    }

    public function insert($dados)
    {
        if ($this->timestamps !== FALSE) {
            $dados[$this->_createdAtField] = $this->_theTimestamp();
        }

        return $this->db->insert($this->table, $dados);
    }

    public function update($id, $dados)
    {
        if ($this->timestamps !== FALSE) {
            $dados[$this->_updatedAtField] = $this->_theTimestamp();
        }

        $this->db->where($this->primaryKey, $id);
        $this->db->set($dados);

        return $this->db->update($this->table);
    }

    public function delete($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->delete($this->table);
    }

    private function _theTimestamp()
    {
        if ($this->timestamps_format == 'timestamp') {
            return time();
        } else {
            return date($this->timestamps_format);
        }
    }

    private function _setTimestamps()
    {
        if ($this->timestamps !== FALSE) {
            $this->_createdAtField = (is_array($this->timestamps) && isset($this->timestamps[0])) ? $this->timestamps[0] : 'created_at';
            $this->_updatedAtField = (is_array($this->timestamps) && isset($this->timestamps[1])) ? $this->timestamps[1] : 'updated_at';
        }
        return TRUE;
    }
}
