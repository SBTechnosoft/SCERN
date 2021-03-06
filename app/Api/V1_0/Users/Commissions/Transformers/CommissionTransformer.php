<?php
namespace ERP\Api\V1_0\Users\Commissions\Transformers;

use Illuminate\Http\Request;
use ERP\Http\Requests;
use ERP\Core\Users\Commissions\Entities\CommissionStatusEnum;
use ERP\Core\Users\Commissions\Entities\CommissionRateTypeEnum;
/**
 * @author Hiren Faldu<hiren.f@siliconbrain.in>
 */
class CommissionTransformer
{
	/**
     * @param Request Object
     * @return array
     */
    public function trimInsertData(Request $request)
    {
		$commissionStatusFlag =0;
		$commissionRateTypeFlag =0;
		
		//data get from body
		$commissionStatus = $request->input('commissionStatus');
		$userId = $request->input('userId'); 
		$commissionType = $request->input('commissionType');
		$commissionRate = $request->input('commissionRate'); 
		$commissionRateType = $request->input('commissionRateType'); 
		$commissionCalcOn = $request->input('commissionCalcOn'); 
		$commissionFor = $request->input('commissionFor');
		
		//trim an input
		$tCommissionStatus = strtolower(trim($commissionStatus));
		$tUserId = trim($userId);
		$tCommissionType = trim($commissionType);
		$tCommissionRate = trim($commissionRate);
		$tCommissionRateType = strtolower(trim($commissionRateType));
		$tCommissionCalcOn = trim($commissionCalcOn);
		$tCommissionFor = trim($commissionFor);

		if($tCommissionStatus !="")
		{
			$enumCommissionStatusArray = array();
			$commissionStatusEnum = new CommissionStatusEnum();
			$enumCommissionStatusArray = $commissionStatusEnum->enumArrays();
			foreach ($enumCommissionStatusArray as $key => $value)
			{
				if(strcmp($value,$tCommissionStatus)==0)
				{
					$commissionStatusFlag = 1;
					break;
				}
				else
				{
					$commissionStatusFlag = 2;
				}
			}
			if ($tCommissionRateType != '') {
				$enumCommissionRateTypeArray = array();
				$commissionRateTypeEnum = new CommissionRateTypeEnum();
				$enumCommissionRateTypeArray = $commissionRateTypeEnum->enumArrays();
				foreach ($enumCommissionRateTypeArray as $key => $value)
				{
					if(strcmp($value,$tCommissionRateType)==0)
					{
						$commissionRateTypeFlag = 1;
						break;
					}
					else
					{
						$commissionRateTypeFlag = 2;
					}
				}
			}
		}
		
		if($commissionStatusFlag == 2 || $commissionRateTypeFlag == 2)
		{
			return "1";
		}
		else
		{
			//make an array
			$data = array();
			if ($tCommissionStatus == 'on') {
				$data['commission_status'] = $tCommissionStatus;
				$data['user_id'] = $tUserId;
				$data['commission_type'] = $tCommissionType;
				$data['commission_rate'] = $tCommissionRate;
				$data['commission_rate_type'] = $tCommissionRateType;
				$data['commission_calc_on'] = $tCommissionCalcOn;
				$data['commission_for'] = $tCommissionFor;
			}
			if ($tCommissionStatus == 'off') {
				$data['commission_status'] = $tCommissionStatus;
				$data['user_id'] = $tUserId;
			}
			return $data;
		}
	}
	public function trimItemwiseInsertData(Request $request)
	{
		$commissionRateTypeFlag =0;

		$companyId = trim($request->input('companyId'));
		$productId = trim($request->input('productId'));
		$fromQty = trim($request->input('commissionFromQty'));
		$toQty = trim($request->input('commissionToQty'));
		$commissionRate = trim($request->input('commissionRate')); 
		$commissionRateType = strtolower(trim($request->input('commissionRateType'))); 
		$commissionCalcOn = trim($request->input('commissionCalcOn'));
		if ($commissionRateType != '') {
			$enumCommissionRateTypeArray = array();
			$commissionRateTypeEnum = new CommissionRateTypeEnum();
			$enumCommissionRateTypeArray = $commissionRateTypeEnum->enumArrays();
			foreach ($enumCommissionRateTypeArray as $key => $value)
			{
				if(strcmp($value,$commissionRateType)==0)
				{
					$commissionRateTypeFlag = 1;
					break;
				}
				else
				{
					$commissionRateTypeFlag = 2;
				}
			}
		}
		if($commissionRateTypeFlag == 2)
		{
			return "1";
		}
		$data = array();
		$data['company_id'] = $companyId;
		$data['product_id'] = $productId;
		$data['commission_from_qty'] = $fromQty;
		$data['commission_to_qty'] = $toQty;
		$data['commission_rate'] = $commissionRate;
		$data['commission_rate_type'] = $commissionRateType;
		$data['commission_calc_on'] = $commissionCalcOn;
		return $data;
	}
}