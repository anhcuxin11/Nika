<resume-edit-job-modal
    :occupations="occupations"
    :industries="industries"
    :change-checkbox="onChangeCheckbox"
    :form="form"
    :occupation-labels="occupationLabels"
    :industry-labels="industryLabels"
    {{-- :occupation-ids="occupation_ids" --}}
    inline-template>
    <div id="job_experience_modal">
        <!-- industries -->
        <div class="modal fade show z-index-modal" id="industry_modal"
        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
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
                                    {{-- class="custom-control-input" --}}
                                        :class="`child_industry_${industry.id}`" :id="`child_industry_check_${child.id}`"
                                        name="industry_ids[]" :value="child.id" data-form="industry_ids"
                                        {{-- :data-parent="`.parent_industry_${industry.id}`" --}}
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
        <div class="modal fade show z-index-modal" id="occupation_modal"
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
                                    {{-- class="custom-control-input" --}}
                                        :class="`child_occupation_${occupation.id}`" :id="`child_occupation_check_${child.id}`"
                                        name="occupation_ids[]" :value="child.id" data-form="occupation_ids"
                                        {{-- :data-parent="`.parent_industry_${industry.id}`" --}}
                                        v-on:change="childrenChange"
                                        :checked="form.occupation_ids.includes(child.id)"
                                        multiple>
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
    </div>
</resume-edit-job-modal>
