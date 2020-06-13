<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <questions v-for="question in questions" :key="question.path" :data=question></questions>

                <div class="text-center">
                    <v-pagination v-model="meta.current_page" :length="meta.total" @input="changePage"></v-pagination>
                </div>

            </v-flex>
            <v-flex xs4>
                <app-sidebar></app-sidebar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import questions from './questions'
import AppSidebar from './AppSideBar'

export default {
    data(){
        return {
            questions:{},
            meta: {},
        }
    },
    components:{questions, AppSidebar},
    created(){
       this.fetchQuestions()
    },
    methods:{
        fetchQuestions(page){
             let url = page ? `/api/question?page=${page}` : '/api/question'
             axios.get(url)
            .then(res => {
                this.questions = res.data.data
                this.meta = res.data.meta
            })
            .catch(error => console.log(error.response.data))
        },
        changePage(page){
            this.fetchQuestions(page)
        }
    }
}
</script>

<style>

</style>
