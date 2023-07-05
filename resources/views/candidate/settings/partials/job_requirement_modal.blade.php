<job-requirement-modal :occupations="occupations" :industries="industries"
    :locations="locations" :change-checkbox="onChangeCheckbox" :form="form" :requirement-employments="requirementEmployments"
    :occupation-labels="occupationLabels" :industry-labels="industryLabels" :location-labels="locationLabels"
    :requirement-employment-label="requirementEmploymentLabel"
    inline-template>
<div id="job_requirement_model">
    {{-- Location --}}
    <div class="modal modal_outer right_modal fade z-index-modal" id="location_requirement_modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Select Locations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                    <span >&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Accordian | start -->
                <section class="accordion_two_section mt-3">
                <div class="row">
                    <div class="col-12 accordionTwo">
                    <div class="panel-group" id="accordionTwoLeft">
                        <div class="panel panel-default">
                        <div class="panel-heading d-none"></div>
                        <div id="collapseTwoLeftone" class="panel-collapse collapse show" aria-expanded="true"
                            role="tablist">
                            <div class="panel-body">
                            <div class="list-children">
                                <div v-for="(location, key) in locations" :key="key" class="row-other" style="">
                                <div class="d-flex" style="line-height: 22px;">
                                    <input type="checkbox" class=""
                                    :id="`child_location_check_${location.id}`" name="location_ids[]"
                                    :value="location.id" data-form="location_ids" v-on:change="childrenChange"
                                    :checked="form.location_ids.includes(location.id)"
                                    multiple>
                                    <label class="mb-0 pl-1"
                                    :for="`child_location_check_${location.id}`">
                                    <span v-text="location.name"></span>
                                    </label>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div> <!-- panel | End -->
                    </div>
                    </div>
                </div>
                </section>
                <!-- Accordian | ends -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="closeModal()">Apply</button>
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- industries -->
    <div class="modal fade show z-index-modal" id="industry_requirement_modal"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
    >
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Select Industries</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                <span >&times;</span>
            </button>
            </div>
            <div class="modal-body" style="height: 73vh; overflow: auto;">
                <div class="panel panel-default mb-2" v-for="(industry, index) in industries" :key="index">
                    <div class="panel-header">
                    <div class="panel-title">
                        <a data-toggle="collapse" class="parent-name"
                        :href="`#collapseIndustry-${industry.id}`" role="button" aria-expanded="false"
                        aria-controls="collapseExample" v-text="industry.name">
                        </a>
                    </div>
                    </div>
                    <div class="collapse" :id="`collapseIndustry-${industry.id}`">
                    <div class="item">
                        <div class="item-children"
                        v-for="child in industry.childrens" :key="`child_industry_check_${child.id}`">
                        <div class="d-flex" style="line-height: 22px;">
                            <input type="checkbox"
                                :class="`child_industry_${industry.id}`" :id="`child_industry_check_${child.id}`"
                                name="industry_ids[]" :value="child.id" data-form="industry_ids"
                                v-on:change="childrenChange"
                                :checked="form.industry_ids.includes(child.id)" multiple>
                            <label class="mb-0" :for="`child_industry_check_${child.id}`">
                                <span v-text="child.name" class="mb-0 ml-2"></span>
                            </label>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="closeModal()">Save changes</button>
            </div>
        </div>
        </div>
    </div>

    <!-- occupations -->
    <div class="modal fade show z-index-modal" id="occupation_requirement_modal"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Select Occupations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                <span >&times;</span>
            </button>
            </div>
            <div class="modal-body" style="height: 73vh; overflow: auto;">
                <div class="panel panel-default mb-2" v-for="(occupation, index) in occupations" :key="index">
                    <div class="panel-header">
                    <div class="panel-title">
                        <a data-toggle="collapse" class="parent-name"
                        :href="`#collapseOccupation-${occupation.id}`" role="button" aria-expanded="false"
                        aria-controls="collapseExample" v-text="occupation.name">
                        </a>
                    </div>
                    </div>
                    <div class="collapse" :id="`collapseOccupation-${occupation.id}`">
                    <div class="item">
                        <div class="item-children"
                        v-for="child in occupation.childrens" :key="`child_occupation_check_${child.id}`">
                        <div class="d-flex" style="line-height: 22px;">
                            <input type="checkbox"
                                :class="`child_occupation_${occupation.id}`" :id="`child_occupation_check_${child.id}`"
                                name="occupation_ids[]" :value="child.id" data-form="occupation_ids"
                                v-on:change="childrenChange"
                                :checked="form.occupation_ids.includes(child.id)" multiple>
                            <label class="mb-0" :for="`child_occupation_check_${child.id}`">
                                <span v-text="child.name" class="mb-0 ml-2"></span>
                            </label>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="closeModal()">Save changes</button>
            </div>
        </div>
        </div>
    </div>

    {{-- Employment --}}
    <div class="modal modal_outer right_modal fade z-index-modal" id="requirement_employment_modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Select Employments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                    <span >&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="accordion_two_section mt-3">
                <div class="row">
                    <div class="col-12 accordionTwo">
                    <div class="panel-group" id="accordionTwoLeft">
                        <div class="panel panel-default">
                        <div class="panel-heading d-none"></div>
                        <div id="collapseTwoLeftone" class="panel-collapse collapse show" aria-expanded="true"
                            role="tablist">
                            <div class="panel-body">
                                <div class="list-children">
                                    <div v-for="(requirementEmployment, key) in requirementEmployments" :key="key" class="row-other" style="">
                                        <div class="d-flex" style="line-height: 22px;">
                                            <input type="checkbox" class=""
                                            :id="`child_requirement_employment_check_${requirementEmployment.value}`" name="requirementEmployment[]"
                                            :value="requirementEmployment.value" data-form="requirementEmployment" v-on:change="childrenChange"
                                            :checked="form.requirementEmployment.includes(requirementEmployment.value)" multiple>
                                            <label class="mb-0 pl-1"
                                                :for="`child_requirement_employment_check_${requirementEmployment.value}`">
                                                <span v-text="requirementEmployment.name"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div> <!-- panel | End -->
                    </div>
                    </div>
                </div>
                </section>
                <!-- Accordian | ends -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="closeModal()">Apply</button>
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>
</job-requirement-modal>
