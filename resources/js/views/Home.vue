<template>
    <div class="container">
        <div class="row m-0">
            <div class="col-6">
                <div>
                    <h3 class="d-inline-block">Posts</h3>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
                        + Nuevo
                    </button>
                </div>
                <div>
                    <p class="d-inline-block">Filtrar</p>
                    <select class="d-inline-block form-control w-25 ml-5" @change="setSelectedCategory($event.target.value)" :value="$store.state.selectedCategory">
                        <option value="">Categoria</option>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                    <input class="d-inline-block ml-5" type="checkbox" :value="$store.state.filterTodayPosts" @change="setFilterTodayPosts($event.target.value)">Today posts
                </div>
            </div>
            <div class="col-6">
                <metrics />
            </div>
        </div>
        <posts-list />
        <post-form />
    </div>
</template>
<script>
import PostsList from '../components/PostsList'
import Metrics from '../components/Metrics'
import PostForm from '../components/PostForm'
export default {
    components: {
        PostsList,
        Metrics,
        PostForm
    },
    methods: {
        setSelectedCategory (val) {
            this.$store.commit('setSelectedCategory', val)
        },
        setFilterTodayPosts (val) {
            this.$store.commit('setFilterTodayPosts', val)
        }
    },
    computed: {
        categories () {
            return this.$store.getters['categories']
        }
    }
}
</script>
