<template>
    <div>
    <div class="m-2"
         v-show="totalSteps > completedSteps">
        <h6 class="text-center">Идет процесс загрузки</h6>
        <radial-progress-bar  :diameter="300"
                             :completed-steps="completedSteps"
                             :total-steps="totalSteps">
            <p>Всего источников для загрузки: {{ totalSteps }}</p>
            <p>Из них загружено: {{ completedSteps }}</p>
        </radial-progress-bar>

    </div>
    <div v-show="totalSteps === completedSteps && totalSteps!== 0"
         class="alert alert-success alert-dismissible fade show m-2"
         role="alert">
        Новости успешно загружены
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>
</template>
<script>

    import RadialProgressBar from 'vue-radial-progress'

    export default {
        components: {
            RadialProgressBar
        },
        props: ['totalSteps'],

        mounted() {
            console.log('mounted');
            window.Echo.channel("workers-progress").listen(".job-number-updated", e => {
                this.completedSteps = this.totalSteps - e.qSize;
            });

            window.Echo.channel("workers-progress").listen(".jobs-send-to-parse", e => {
                this.totalSteps = e.qSize;

            });
        },
        data() {
            return {
                completedSteps: 0,
                totalSteps: 0
            }
        },


    }
</script>
