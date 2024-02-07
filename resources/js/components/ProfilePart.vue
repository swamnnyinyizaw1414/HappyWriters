<template>
    <div class="container">
        <!-- Profile Part -->
        <div  v-if="username" class="modal fade" id="profilePart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Your Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mx-2" method="post" @submit.prevent="updateProfile" enctype="multipart/form-data">
                            <div class="d-block d-sm-flex align-items-center my-2 mb-4">
                                <div v-if="!currentUserProfilePicture" data-bs-toggle="modal" data-bs-target="#profilePart"
                                    style="width:70px; height:70px; border-radius: 50%;"
                                    class="mx-2 btn btn-dark d-flex justify-content-center align-items-center ">
                                    <h2 class="mb-0">{{ username.slice(0, 1) }}</h2>
                                </div>
                                <img v-else :src="'/storage/' + currentUserProfilePicture"
                                    style="width:70px; height:70px; border-radius: 50%;" class="user-profile mx-2" alt="">
                                <div class="ms-2 mt-3 mt-md-0 ms-3 ms-md-0">
                                    <p class="fw-bold mb-1">Upload Profile Picture</p>
                                    <div v-if="form.errors.profile_picture">
                                        <p class="text-danger">{{ form.errors.profile_picture }}</p>
                                    </div>
                                    <input type="file" @change="getFileInputValue" class="">
                                </div>
                            </div>

                            <div class="my-3 ms-3">
                                <label for="name">Name</label>
                                <input type="text" v-model="form.name" class="form-control rounded-0 border-0 border-bottom"
                                    id="name">
                                <div v-if="form.errors.name">
                                    <p class="text-danger">{{ form.errors.name }}</p>
                                </div>
                            </div>

                            <div class="my-3 ms-3">
                                <label for="bio">Bio</label>
                                <input type="text" v-model="form.bio" class="form-control rounded-0 border-0 border-bottom"
                                    id="bio">
                                <div v-if="form.errors.bio">
                                    <p class="text-danger">{{ form.errors.bio }}</p>
                                </div>
                            </div>

                            <div class="mt-3 text-end">
                                <button type="button" class="d-none d-lg-inline-block btn btn-secondary mx-1" data-bs-dismiss="modal">Close</button>
                                <form action="/redirect" class="d-inline-block d-lg-none me-1" method="post">
                                    <button class="btn btn-danger">Logout</button>
                                </form>
                                <button class="btn text-white" style="background-color: #fc5185;">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue'
let page = usePage()
let username = computed(() => {
    return page.props.auth.user.username;
});

let currentUserBio = computed(() => {
    return page.props.auth.user.currentUserBio;
});

let currentUserProfilePicture = computed(() => {
    // console.log(page.props.auth.user.currentUserProfilePicture)
    return page.props.auth.user.currentUserProfilePicture;
})

let form = useForm({
    name: username.value,
    bio: currentUserBio.value,
    profile_picture: '',
    profile_picture_name: '',
})

let getFileInputValue = (event) => {
    let file = event.target.files[0]
    console.log(file)
    form.profile_picture = file
    form.profile_picture_name = file.name
}

let updateProfile = () => {
    form.post('/profile');
} 

</script>

<style>

</style>