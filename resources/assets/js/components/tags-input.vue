<template>
    <div style="height:auto;max-width: 100%;overflow-x: auto;" class="form-control">
        <span v-for="tag in tags" style="margin-right: 5px" class="label label-info">{{tag}} <a
                v-on:click="remove(tag)"><span class="glyphicon glyphicon-remove"></span></a></span>
        <input style="border: none; box-shadow: none; outline: none; width: auto" v-on:keyup.188="add"
               v-on:keyup.32="add"/>
        <select style="display: none" v-bind:id="name" v-bind:name="name" multiple="multiple">
            <option v-for="tag in tags" selected="selected">{{tag}}</option>
        </select>
    </div>
</template>
<script>
export default {
    props: ["name", "value"],
    data: function () {
        return {tags: []};
    },
    mounted: function () {
        this.tags = JSON.parse(this.value);
    },
    methods: {
        remove: function (tag) {
            this.tags = this.tags.filter(item => item !== tag);
        },
        add: function (event) {
            if (event.target.value != '') this.tags.push(event.target.value.replace(",", "").replace(" ", ""));
            event.target.value = '';
        }
    }
}
</script>