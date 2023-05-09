export default {
    props: {
      dataCollapse: {
        required: true
      },
      dataSelected: {
        required: true
      },
      name: {
        required: true
      },
      titleLabel: {
        required: false
      }
    },
    data() {
      return {
        title: this.titleLabel,
        isModalVisible: false,
        collapses: this.dataCollapse,
        listCollapseSelectedId: [],
        listCollapseSelected: [],
        dataCollapseSelectedOrigin: [],
        dataCollapseSelectedApply: [],
      };
    },
    mounted() {
        for (let collapseParentId in this.dataSelected) {
            let collapseParent = this.dataCollapse.filter(o => o.id == collapseParentId);
            if (!collapseParent.length) {
                continue;
            }

            let selectIds = [];
            for (let collapseSelectedId in this.dataSelected[collapseParentId]) {
                selectIds.push(parseInt(collapseSelectedId));
                let collapseChildrens = collapseParent[0].childrens.filter(o => o.id == collapseSelectedId);
                if (!collapseChildrens.length) {
                continue;
                }
                let collapseChildren = collapseChildrens[0];
                this.listCollapseSelected.push(collapseChildren);
            }
        }

        this.listCollapseSelectedId = this.listCollapseSelected.map(function (el) { return el.id });
        this.dataCollapseSelectedApply = this.listCollapseSelected;
        this.dataCollapseSelectedOrigin = this.listCollapseSelected;
    },
    methods: {
        checkChildren(index, parentId, item, event) {
            if (event.target.checked) {
              if (!this.listCollapseSelected.includes(item)) {
                this.listCollapseSelected.push(item);
                this.listCollapseSelectedId = this.listCollapseSelected.map(function (el) { return el.id });
              }
            } else {
              let tmp = this.listCollapseSelected;
              this.listCollapseSelected = tmp.filter(o => o != item);
              this.listCollapseSelectedId = this.listCollapseSelected.map(function (el) { return el.id });
            }
        },
        showModal() {
            this.dataCollapseSelectedApply = [...this.dataCollapseSelectedOrigin];
            this.listCollapseSelected = [...this.dataCollapseSelectedApply];
            this.listCollapseSelectedId = this.listCollapseSelected.map(function (el) { return el.id });
            this.isModalVisible = true;
        },
        closeModal() {
            this.dataCollapseSelectedApply = [...this.dataCollapseSelectedOrigin];
            this.listCollapseSelected = [...this.dataCollapseSelectedOrigin];
            this.listCollapseSelectedId = this.listCollapseSelected.map(function (el) { return el.id });
            this.isModalVisible = false;
        },
        applyCondition() {
            this.dataCollapseSelectedOrigin = [...this.listCollapseSelected];
            this.dataCollapseSelectedApply = [...this.listCollapseSelected];
            this.isModalVisible = false;
        }
    },
    computed: {
        displayModal: function () {
            return this.isModalVisible ? 'block' : 'none';
        },
        listSelectedApplyLabel: function () {
            if (this.dataCollapseSelectedApply.length) {
              return this.dataCollapseSelectedApply.map(function (el) { return el.name }).join(' / ');
            }

            return '';
        }
    }
}
