<template>
    <input type="text" class="form-control" v-bind:id="name" v-bind:name="name" v-bind:placehoder="placeholder"/>
</template>

<script>
export default {
    props: ["name", "placeholder", "min_picker"],
    mounted: function () {
        self = this;
        $(this.$el).datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss",
            useCurrent: (this.min_picker == null) ? true : false
        });
        if (this.min_picker != null) {
            $("#" + this.min_picker).on("dp.change", function (e) {
                $(self.$el).data("DateTimePicker").minDate(e.date);
            });
        }

    }
}
</script>