<template>
    <div id="jobview" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{job.type}}</h4>
                </div>
                <div class="modal-body" style="overflow-y: auto; overflow-x:hidden;height: 400px">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="control-label row">Created at</div>
                            <div class="row form-control">{{ job.created_at }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="control-label row">Available at</div>
                            <div class="row form-control">{{ job.available_at }}</div>
                        </div>
                        <div v-show="job.exception" class="col-sm-4">
                            <div class="control-label row">Failed at</div>
                            <div class="row form-control">{{ job.failed_at }}</div>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div v-for="(value, key) in job.task.data.command" class="form-group">
                            <div class="control-label col-sm-3">{{key}}</div>
                            <div class="col-sm-9">{{value}}</div>
                        </div>
                    </div>
                    <div v-show="job.exception" class="row">
                        <div class="col-sm-12">
                            <div class="control-label row">Exception</div>
                            <div class="row">
                            <textarea style="resize: none" rows="15" class="form-control"
                                      disabled="disabled">{{ job.exception }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {job: {task: {data: {command: {}}}}};
    },
    methods: {
        openview: function (job) {
            this.job = job;
            $(this.$el).modal('show');
        }
    },
    mounted: function () {
        this.$eventBus.$on("open-job", this.openview);
    }

}
</script>