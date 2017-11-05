<template>
    <div></div>
</template>
<script>
export default {
    props: {
        events: {
            required: true
        },
    },

    data: function () {
        return {
            cal: null
        }
    },

    mounted: function () {
        var self = this;
        self.cal = $(self.$el);


        var args = {
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            height: "auto",
            allDaySlot: false,
            slotEventOverlap: false,
            timeFormat: 'HH:mm',

            events: self.events,
            startParam: "maintenance_start",
            endParam: "maintenance_end"
        };
        this.cal.fullCalendar(args);

    }
}
</script>