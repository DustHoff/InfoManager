<template>
    <div style="height:auto;max-width: 100%;overflow-x: auto;" class="form-control">
        <span v-for="tag in tags" style="margin-right: 5px" class="label label-info">{{tag}} <a
                v-on:click="remove(tag)"><span class="glyphicon glyphicon-remove"></span></a></span>
        <autocomplete-input v-bind:url="url" v-bind:field="field" v-bind:keys="keys" name=""
                            cssstyle="border: none; box-shadow: none; outline: none; width: auto" v-on:keyup="add"
                            v-on:clicked="add"/>
        <select style="display: none" v-bind:id="name" v-bind:name="name" multiple="multiple">
            <option v-for="tag in tags" selected="selected">{{tag}}</option>
        </select>
    </div>
</template>
<script>
export default {
    props: ["name", "value", "url", "field"],
    data: function () {
        return {tags: [], keys: [188, 32]};
    },
    mounted: function () {
        this.tags = JSON.parse(this.value);
    },
    methods: {
        remove: function (tag) {
            this.tags = this.tags.filter(item => item !== tag);
        },
        add: function (event) {
            if (event.input != '') this.tags.push(event.input.replace(",", "").replace(" ", ""));
        }
    }
}
</script>