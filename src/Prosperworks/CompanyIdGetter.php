<?php

namespace App\Prosperworks;

use App\Prosperworks\Company\DataLister;
use App\Resource\IdGetterInterface;

class CompanyIdGetter implements IdGetterInterface
{
    /**
     * @var DataLister
     */
    private $dataLister = null;

    /**
     * @param DataLister $dataLister
     */
    public function __construct(DataLister $dataLister)
    {
        $this->dataLister = $dataLister;
    }

    /**
     * {@inheritDoc}
     *
     * Warning: Company names are not unique.
     */
    public function getIdByName(string $name): ?int
    {
        $companyDataList = $this->dataLister->getCompanyDataList();

        $companyList = json_decode($companyDataList, true);

        foreach($companyList as $company) {
            if ($company['name'] === $name) {
                return $company['id'];
            }
        }

        throw new \Exception(sprintf('Company %s not found', $name), 1);
    }
}
