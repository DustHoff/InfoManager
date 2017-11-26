<template>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <textarea v-bind="name" v-model="template"></textarea>
        </div>
        <div class="col-sm-6">
            {{ this.view }}
        </div>
    </div>
</template>
<script>
export default {
    props: ["url", "name"],
    data: function () {
        return {template: "", view}
    },
    methods: {
        translate: function (event) {
            axios.post(this.url, {template: this.template}).then(response => {

            });
        }
    }
}
</script>