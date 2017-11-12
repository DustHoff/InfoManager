<template>
    <autocomplete-input cssclass="form-control" name="search" aria="searchButton"
                        v-bind:url="searchurl" field="name" objfield="name" v-on:clicked="selected">
    <span id="searchButton" class="input-group-btn">
                    <button class="btn"
                            type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    </span>
    </autocomplete-input>
</template>
<script>
export default {
    props: ["searchurl", "refurl"],
    methods: {
        selected: function (obj) {
            window.location.href = this.refurl + "/" + obj.input["id"];
        }
    }
}
</script>