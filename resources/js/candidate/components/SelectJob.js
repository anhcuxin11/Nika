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
        collapses: this.dataCollapse,
        listCollapseSelectedId: [],
      };
    },
}
