<template>
    <li v-show="jobs.length!=0" class="dropdown">
        <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Jobs ({{ jobs.length }}) <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li v-for="job in jobs" :key="job.id+job.type">
                <a v-on:click="openJob(job)">{{ job.type }}</a>
            </li>
        </ul>

        <viewjob/>
    </li>
</template>

<script>
export default {
    props: ["url"],
    data() {
        return {jobs: []};
    },
    methods: {
        openJob: function (job) {
            this.$eventBus.$emit("open-job", job);
        },
        refresh: function () {
            axios.get(this.url).then(response => {
                this.jobs = response.data;
            });
        }
    },
    mounted: function () {
        this.refresh();
        setInterval(function () {
            this.refresh();
        }.bind(this), 15000);
    }
};
</script>