<template>
    <div v-if="projects">
        <project v-for="(project, index) in projects" :key="index" :project="project"></project>
    </div>
</template>

<script>
import store from '../store';
import Project from '../components/Project';

export default {
    components: {
        Project
    },

    computed: {
        projects() {
            return store.getters.projects
        }
    },
}
</script>
