<template>
    <div>
        <div class="input-group">
            <input v-bind:name="name" v-bind:class="cssclass" v-bind:style="cssstyle" v-bind:aria-descriptedby="aria"
                   v-model.trim="input" v-on:keyup="keyup"
                   v-on:focus="toggle" v-on:blur="toggle" autocomplete="off"/>
            <slot></slot>
        </div>
        <ul v-show="visible" class="list-group" style="position: absolute; z-index: 1000">
            <li href="#" v-show="options.length!=0" v-for="option in options" class="list-group-item"
                v-on:click="clicked(option)">{{option[objfield]}}
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        name: {required: true},
        cssclass: {required: false},
        cssstyle: {required: false},
        url: {required: false},
        objfield: {required: true},
        field: {required: false},
        keys: {
            type: Array,
            required: false
        },
        aria: {required: false}
    },
    data: function () {
        return {input: "", options: [], visible: false}
    },
    methods: {
        toggle: function () {
            self = this;
            _.delay(function () {
                self.visible = !self.visible;
            }, 500);
        },
        clicked: function (item) {
            this.input = "";
            this.$emit('clicked', {input: item});
        },
        keyup: function (event) {
            if (this.keys == null) return;
            if (this.keys.indexOf(event.keyCode) !== -1) {
                var item = {};
                item[this.objfield] = this.input;
                this.$emit('keyup', {input: item});
                this.input = "";
            }
        }
    },
    watch: {
        input: _.debounce(function (input) {
            if (this.url == null) return;
            self = this;
            axios.get(this.url + '?' + this.field + '=' + encodeURI(this.input)).then(function (response) {
                self.options = response.data;
            }, 1, {maxWait: 2});
        })
    }
}
</script>