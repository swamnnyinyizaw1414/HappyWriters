<template>

  <Navbar :isCreatePage="true"></Navbar>

    <!-- Create Post -->
    <div class="container">
        <div class="row d-flex justify-content-center" style="position: relative; top: 80px;">
            <div class="col-md-12 col-lg-6 px-3">
                <div class="text-center">
                    <h3 class="my-3 fw-bold">Writing.....</h3>
                </div>
                <form class="my-3" method="post" @submit.prevent="createBlog" enctype="multipart/form-data">
                    <div class="form-group my-4">
                        <label for="title"><h5>Title</h5></label>
                        <input type="text" v-model="form.title" id="title" class="form-control">
                        <div v-if="form.errors.title"><p class="text-danger">{{ form.errors.title }}</p></div>
                    </div>
                    <div class="form-group my-4">
                        <label for="body"><h5>Body</h5></label>
                        <textarea class="form-control p-3" v-model="form.body" id="body" cols="30" rows="10"></textarea>
                        <div v-if="form.errors.body"><p class="text-danger">{{ form.errors.body }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group my-3">
                                <label for="feature_photo"><h5>Featured Photo</h5></label>
                                <input @change="getFileInputValue" class="form-control" type="file" id="feature_photo">
                                <div v-if="form.errors.file"><p class="text-danger">{{ form.errors.file }}</p></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-3">
                                <label for="topic"><h5>Topic</h5></label>
                                <input type="text" v-model="form.topic" id="topic" class="form-control">
                                <div v-if="form.errors.topic"><p class="text-danger">{{ form.errors.topic }}</p></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn text-white px-4" style="background-color:#fc5185">Post</button>
                </form>
            </div>
        </div>

        <BotNav/>

        <!-- Profile Part -->
        <ProfilePart/>

    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import ProfilePart from '../components/ProfilePart.vue';
import BotNav from '../components/BotNav.vue';
import { useForm } from '@inertiajs/vue3';

    let props=defineProps({errors:Object})

    let form=useForm({
        title: '',
        body: '',
        file: Object,
        feature_photo: '',
        topic: '',
    })

    const getFileInputValue = (event) => {
        const file = event.target.files[0]
        console.log(file)
        form.feature_photo=file.name
        console.log(form.feature_photo)
        form.file=file
    }

    let createBlog=()=>{
        form.post('/blog/store')
    }
    

</script>

<style>
    
</style>