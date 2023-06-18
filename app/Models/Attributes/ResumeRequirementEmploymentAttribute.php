<?php

namespace App\Models\Attributes;

use App\Models\ResumeRequirementEmployment;

trait ResumeRequirementEmploymentAttribute
{
    /**
     * Get requirement employment label.
     *
     * @return string
     */

    public function getRequirementEmploymentLabelAttribute(): string
    {
        switch ($this->requirement_employment) {
            case ResumeRequirementEmployment::$requirementEmployment['permanent']:
                return 'Permanent';
            case ResumeRequirementEmployment::$requirementEmployment['contractor']:
                return 'Contractor';
            case ResumeRequirementEmployment::$requirementEmployment['outsourcing']:
                return 'Outsourcing';
            case ResumeRequirementEmployment::$requirementEmployment['contingent_worker']:
                return 'Contingent Worker';
            case ResumeRequirementEmployment::$requirementEmployment['part_time']:
                return 'Part-time';
            default:
                return '';
        }
    }
}
