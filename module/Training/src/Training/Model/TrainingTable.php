<?php 

namespace Training\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

/**
* 
*/
class TrainingTable extends AbstractTableGateway
{
	public function __construct(Adapter $adapter)
	{

		$this->adapter = $adapter;
		$this->table ='training';
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Training());
        $this->initialize();
	}
	public function fetchAll()
    {
        return $this->select();
    }
    public function getTraining($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveTraining(Training $training)
    {
        $data = array(
            'name' => $training->name,
            'value'  => $training->value,
        );

        $id = (int)$training->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getTraining($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteTraining($id)
    {
        $this->delete(array('id' => $id));
    }
}
 ?>