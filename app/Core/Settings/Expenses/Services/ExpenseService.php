<?php
namespace ERP\Core\Settings\Expenses\Services;

use ERP\Core\Settings\Expenses\Persistables\ExpensePersistable;
use ERP\Model\Settings\Expenses\ExpenseModel;
use ERP\Core\Shared\Options\UpdateOptions;
use ERP\Core\Support\Service\AbstractService;
use ERP\Core\User\Entities\User;
use ERP\Core\Settings\Expenses\Entities\EncodeData;
use ERP\Core\Settings\Expenses\Entities\EncodeAllData;
use ERP\Exceptions\ExceptionMessage;
/**
 * @author Reema Patel<reema.p@siliconbrain.in>
 */
class ExpenseService extends AbstractService
{
    /**
     * @var expenseService
	 * $var expenseModel
     */
    private $expenseService;
    private $expenseModel;
	
    /**
     * @param ExpenseService $expenseService
     */
    public function initialize(ExpenseService $expenseService)
    {		
		echo "init";
    }
	
    /**
     * @param ExpensePersistable $persistable
     */
    public function create(ExpensePersistable $persistable)
    {
		return "create method of ExpenseService";
		
    }
	
	 /**
     * get the data from persistable object and call the model for database insertion opertation
     * @param ExpensePersistable $persistable
     * @return status
     */
	public function insert()
	{
		$expenseArray = array();
		$getData = array();
		$keyName = array();
		$funcName = array();
		$expenseArray = func_get_arg(0);
		for($data=0;$data<count($expenseArray);$data++)
		{
			$funcName[$data] = $expenseArray[$data][0]->getName();
			$getData[$data] = $expenseArray[$data][0]->$funcName[$data]();
			$keyName[$data] = $expenseArray[$data][0]->getkey();
		}
		//data pass to the model object for insert
		$expenseModel = new ExpenseModel();
		$status = $expenseModel->insertData($getData,$keyName);
		return $status;
	}
	
	/**
     * get all the data and call the model for database selection opertation
     * @return status
     */
	public function getAllExpenseData()
	{
		$expenseModel = new ExpenseModel();
		$status = $expenseModel->getAllData();
		//get exception message
		$exception = new ExceptionMessage();
		$exceptionArray = $exception->messageArrays();
		if(strcmp($status,$exceptionArray['204'])==0)
		{
			return $status;
		}
		else
		{
			$encoded = new EncodeAllData();
			$encodeAllData = $encoded->getEncodedAllData($status);
			return $encodeAllData;
		}
	}
	
	/**
     * get all the data  as per given id and call the model for database selection opertation
     * @param $expenseId
     * @return status
     */
	public function getExpenseData($expenseId)
	{
		$expenseModel = new ExpenseModel();
		$status = $expenseModel->getData($expenseId);
		//get exception message
		$exception = new ExceptionMessage();
		$exceptionArray = $exception->messageArrays();
		if(strcmp($status,$exceptionArray['404'])==0)
		{
			return $status;
		}
		else
		{
			$encoded = new EncodeData();
			$encodeData = $encoded->getEncodedData($status);
			return $encodeData;
		}
	}
	
    /**
     * get the data from persistable object and call the model for database update opertation
     * @param SettingPersistable $persistable
     * @param updateOptions $options [optional]
	 * parameter is in array form.
     * @return status
     */
    public function update()
    {
		$expenseArray = array();
		$getData = array();
		$funcName = array();
		$expenseArray = func_get_arg(0);
		for($data=0;$data<count($expenseArray);$data++)
		{
			$funcName[$data] = $expenseArray[$data][0]->getName();
			$getData[$data] = $expenseArray[$data][0]->$funcName[$data]();
			$keyName[$data] = $expenseArray[$data][0]->getkey();
		}
		$expenseId = $expenseArray[0][0]->getExpenseId();
		// data pass to the model object for update
		$expenseModel = new ExpenseModel();
		$status = $expenseModel->updateData($getData,$keyName,$expenseId);
		return $status;	
	}

    /**
     * get and invoke method is of Container Interface method
     * @param int $id,$name
     */
    public function get($id,$name)
    {
		echo "get";		
    }   
	public function invoke(callable $method)
	{
		echo "invoke";
	}
	
    /**
     * @param delete
     * @param expense-id
     */
    public function delete($expenseId)
    {      
		$expenseModel = new ExpenseModel();
		$status = $expenseModel->deleteData($expenseId);
		return $status;
    }   
}