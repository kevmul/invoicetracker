<template>
    <div class="counter">
        {{count}}
        <p>
            <button @click="increment">+1</button>
        </p>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';

    export default {
        computed: mapState(['count']),

        methods: mapActions(['increment']),
    }
</script>
