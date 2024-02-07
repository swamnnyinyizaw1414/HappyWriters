<template>
    <div class="text-center mb-5">
        <h3 class="fw-bold">Login</h3>
        <hr style="color: #fc5185; border: 1px solid">
    </div>
    <div class="">
        <form @submit.prevent="login" method="post">
            <ul>
                <li v-if="form.errors.email" class="text-danger">
                    {{ form.errors.email }}
                </li>
                <li v-if="form.errors.password" class="text-danger">
                    {{ form.errors.password }}
                </li>
            </ul>
            <input type="email" v-model="form.email" placeholder="Email" class="form-control mt-3">
            <input type="password" v-model="form.password" placeholder="Password" class="form-control mt-3">
            <div class="text-center">
                <button class="btn text-white mt-3" style="background-color: #fc5185;">Login</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3"

    let props=defineProps({errors:Object,})

    let form=useForm({
        email: '',
        password: ''
    })

    let login=()=>{
        form.post('/login')
    }
</script>

<style>

</style>