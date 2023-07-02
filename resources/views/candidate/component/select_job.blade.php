<div id="job-industry">
  <div class="m-0 l-0" v-for="(item, index) in dataCollapseSelectedApply"
    :key="`${index}_${item.id}`">
    <input type="hidden" :value="item.id" :name="`${name}[${item.parent_id}][${item.id}][id]`" />
  </div>
  <button type="button" class="btn-search" style="cursor: pointer; background-color: white;"
  @click="showModal">
    {{ $buttonName }}
  </button>

  <p class="mb-0" style="background-color:white; color:black;" v-show="listSelectedApplyLabel">@{{ listSelectedApplyLabel }}</p>

  <!-- Modal -->
  <div class="modal fade show z-index-modal" id="exampleModal"
  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  :style="{ display: displayModal}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@{{ title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
            <span >&times;</span>
          </button>
        </div>
        <div class="modal-body" style="height: 73vh; overflow: auto;">
          <div class="panel panel-default mb-2" v-for="(parent, index) in collapses" :key="index">
            <div class="panel-header">
              <div class="panel-title">
                <a data-toggle="collapse" class="parent-name"
                :href="`#collapseParent-${name}-${parent.id}`" role="button" aria-expanded="false"
                aria-controls="collapseExample">
                  @{{ parent.name }}
                </a>
              </div>
            </div>
            <div class="collapse" :id="`collapseParent-${name}-${parent.id}`">
              <div class="item">
                <div class="item-children"
                v-for="children in parent.childrens">
                  <div class="d-flex" style="line-height: 22px;">
                    <input type="checkbox"
                    @click="checkChildren(index, parent.id, children, $event)"
                    :value="children.id"
                    v-model="listCollapseSelectedId"
                    :id="`${name}-${children.id}`">
                    <label :for="`${name}-${children.id}`" class="mb-0 ml-2">@{{ children.name }}</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="applyCondition()">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
