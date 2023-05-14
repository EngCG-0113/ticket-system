<template>
    <div>
        <div>
            <button class="btn btn-outline-secondary" @click="$emit(`page-clicked`,pagination.current_page - 1)" :disabled="pagination.current_page == pagination.from"> &lt; </button>
            <button class="btn btn-outline-secondary" disabled>{{pagination.current_page}} / {{pagination.last_page}}</button>
            <button class="btn btn-outline-secondary" @click="$emit(`page-clicked`,pagination.current_page + 1)" :disabled="pagination.current_page == pagination.last_page"> &gt; </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            pagination:{
                type: Object
            }
        },
        data() {
            return {

            }
        },
        methods:{
        }
    }
</script>
