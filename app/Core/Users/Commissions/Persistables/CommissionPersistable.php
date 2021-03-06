<?php
namespace ERP\Core\Users\Commissions\Persistables;
use ERP\Core\Shared\Properties\NamePropertyTrait;
use ERP\Core\Shared\Properties\KeyPropertyTrait;

use ERP\Core\Users\Commissions\Properties\CommissionIdPropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionStatusPropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionTypePropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionRatePropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionRateTypePropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionCalcOnPropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionForPropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionFromQtyPropertyTrait;
use ERP\Core\Users\Commissions\Properties\CommissionToQtyPropertyTrait;
use ERP\Core\Users\Properties\UserIdPropertyTrait;
use ERP\Core\Products\Properties\ProductIdPropertyTrait;
use ERP\Core\Companies\Properties\CompanyIdPropertyTrait;
/**
 * @author Hiren Faldu<hiren.f@siliconbrain.in>
 */
class CommissionPersistable
{
    use NamePropertyTrait;
    use KeyPropertyTrait;

    use CommissionIdPropertyTrait;
    use CommissionStatusPropertyTrait;
    use CommissionTypePropertyTrait;
    use CommissionRatePropertyTrait;
    use CommissionRateTypePropertyTrait;
    use CommissionCalcOnPropertyTrait;
    use CommissionForPropertyTrait;
    use CommissionFromQtyPropertyTrait;
    use CommissionToQtyPropertyTrait;
    use UserIdPropertyTrait;
    use ProductIdPropertyTrait;
    use CompanyIdPropertyTrait;
}