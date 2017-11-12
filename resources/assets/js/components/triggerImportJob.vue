<template>
    <div class="col-sm-10">
        <div v-show="!this.view" class="input-group">
            <input name="address" :value="this.address" class="form-control"/>
            <span class="input-group-btn">
                <button class="btn btn-default" v-on:click.prevent.stop="openView" v-bind:disabled="address==''">
                    <span class="glyphicon glyphicon-import"></span>
                </button>
            </span>
        </div>
        <div v-show="this.view">
            <div class="form-group">
                <div class="control-label col-sm-2">{{ i18n("menu.username") }}</div>
                <div class="col-sm-10">
                    <input class="form-control" v-model="username"/>
                </div>
            </div>
            <div class="form-group">
                <div class="control-label col-sm-2">{{ i18n("menu.password") }}</div>
                <div class="col-sm-10">
                    <input class="form-control" type="password" v-model="password"/>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <div class="col-sm-offset-6 col-sm-3">
                    <button class="btn btn-default" data-toggle="button" v-on:click="toggleRepeat" autocomplete="off">
                        {{ i18n("menu.repeat") }}
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-default" v-on:click.prevent.stop="startJob">
                        <span class="glyphicon glyphicon-play"></span> {{ i18n("menu.start_job") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["url", "address"],
    data() {
        return {view: false, username: "", password: "", type: "EsxiHostImportJob", repeat: false};
    },
    methods: {
        openView: function (event) {
            this.view = true;
        },
        startJob: function () {
            axios.post(this.url, JSON.stringify(
                {
                    username: this.username,
                    password: this.password,
                    type: this.type,
                    repeat: this.repeat
                })).then(response => {
                this.view = false;
            })
        },
        toggleRepeat: function (event) {
            this.repeat = !this.repeat;
        }
    }
}
</script>