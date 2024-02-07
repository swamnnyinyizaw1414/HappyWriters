<template>
    <div class="text-center mb-5">
            <h3 class="fw-bold">Sign Up</h3>
            <hr style="color: #fc5185; border: 1px solid">
        </div>
        <div class="">
            <form method="post" @submit.prevent="signup">
                <input type="text" placeholder="Name" v-model="form.name" class="form-control mt-3">
                <div v-if="form.errors.name"><p class="text-danger">{{ form.errors.name }}</p></div>
                <input type="email" placeholder="Email" v-model="form.email" class="form-control mt-3">
                <div v-if="form.errors.email"><p class="text-danger">{{ form.errors.email }}</p></div>
                <input type="password" placeholder="Password" v-model="form.password" class="form-control mt-3">
                <div v-if="form.errors.password"><p class="text-danger">{{ form.errors.password }}</p></div>
                <input type="password" placeholder="Confirm Password" v-model="form.confirmPassword" class="form-control mt-3">
                <p v-if="error" class="text-danger">{{ error }}</p>
                <div class="text-center">
                    <button class="btn text-white mt-3" style="background-color: #fc5185;">Sign up</button>
                </div>
            </form>
        </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3"
import { ref } from "vue"
    let props=defineProps({
        errors:Object,
    })
    let error=ref('');
    let form =useForm({
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
    })
    
    let signup=()=>{
        if(form.password!=form.confirmPassword){
            error.value="Password doesn't match!!!"
        }
        else{
            error.value='';
            form.post('/signup');
        }
    }
</script>

<style>

</style>