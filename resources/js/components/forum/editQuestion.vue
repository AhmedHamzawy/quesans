<template>
    <v-container>
        <v-card>
            <v-form
            ref="form"
            @submit.prevent="update"
            >
            
            <v-text-field
            v-model="form.title"
            label="Title"
            type="text"
            required
            ></v-text-field>   

            <vue-simplemde v-model="form.body" ref="markdownEditor" />

            <v-card-actions>

                <v-btn type="submit" icon small>
                   <v-icon color="green">mdi-Edit</v-icon> 
                </v-btn>

                <v-btn @click="cancel" icon small>
                   <v-icon color="green">mdi-Cancel</v-icon> 
                </v-btn>

        </v-card-actions>
        
        </v-form>

        </v-card>
        
    </v-container>
</template>

<script>
export default {
    props: ['data'],
    data(){
        return {
            form:{
                title: null,
                body:  null
            }
        }
    },
    methods:{
        cancel(){
            EventBus.$emit('cancelEditing')
        },
        update(){
            axios.patch(`/api/question/${this.form.slug}`, this.form)
            .then(res => this.cancel())
            .catch(error => console.log(error))
        }
    },
    mounted(){
        this.form = this.data
    }
}
</script>

<style>

</style>
