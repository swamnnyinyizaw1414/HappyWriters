<template>
    <div class="col-md-12 col-lg-4 additionalPart d-lg-flex category-cloud justify-content-center ">
        <div class="row">
            <div class="col-12">
                <!-- Top blogs --> 
                <h6 class="fw-bold pt-3">Top blogs of this week</h6>
                <div v-for="tb in topBlogs" :key="tb.id" class="pt-2">

                    <div class="ps-3 pt-1">
                        <div class="d-flex align-items-center ">
                            <div class="me-2">
                                <div v-if="!tb.user.profile_picture" style="width: 35px; height: 35px; border-radius: 50%;" class="bg-dark text-white d-flex justify-content-center align-items-center ">
                                    <h5 class="mb-0">{{ tb.user.name.slice(0, 1) }}</h5>
                                </div>
                                <img v-else class="user-profile-img"
                                    :src="'storage/'+tb.user.profile_picture"
                                    alt="">
                            </div>
                            <span class="me-2 ">{{ tb.user.name }}</span>
                            <!-- <div v-if="auth_id != tb.user_id">
                                <Link v-if="isFollowing(tb.user_id)" :href="'/unfollow/' + tb.user_id" method="post"
                                    preserve-scroll class="text-decoration-none text-dark fw-bold">. Following</Link>
                                <Link v-else :href="'/follow/' + tb.user_id" method="post" preserve-scroll
                                    class="text-decoration-none text-dark fw-bold">. Follow</Link>
                            </div> -->
                        </div>
                        <div class="mt-2">
                            <Link :href="'blogs/' + tb.id" class="text-decoration-none text-dark">
                            <h6 class="fw-bold">{{ tb.title }}</h6>
                            </Link>
                        </div>
                    </div>
                </div>
                <a href="" class=" mx-4" style="color:#000;"><span>See All</span></a>

                <!-- Topics -->
                <div class="my-5">
                    <div class="">
                        <h6 class="fw-bold">Topics</h6>
                        <div class="ps-3 py-2">
                            <span v-for="blog in blogs" :key="blog.id" class="badge bg-secondary p-2 mb-2 me-2">{{
                                blog.topic }}</span>
                        </div>
                        <a href="" class=" mx-4" style="color:#000;"><span>See All</span></a>
                    </div>
                </div>

                <!-- Popular Writers -->
                <div class="my-5">
                    <h6 class="fw-bold">Popular Writers</h6>
                    <div v-for="tb in topBloggers" :key="tb.id"
                        class="py-2 ps-3 d-flex align-items-center justify-content-between">
                        <div class="mb-2 me-3">
                            <div class="d-flex align-items-start">
                                <div class="me-2">
                                    <div v-if="!tb.profile_picture" style="width: 35px; height: 35px; border-radius: 50%;" class="bg-dark text-white d-flex justify-content-center align-items-center ">
                                        <h5 class="mb-0">{{ tb.name.slice(0, 1) }}</h5>
                                    </div>
                                    <img v-else class="user-profile-img"
                                        :src="'storage/'+tb.profile_picture"
                                        alt="">
                                </div>
                                <div class="">
                                    <p class="mb-0">{{ tb.name }}</p>
                                    <span class="text-black-50">{{tb.bio}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="" v-if="auth_id != tb.id">
                            <button v-if="isFollowing(tb.id)" class="btn btn-sm text-light" style="background-color:#fc5185">
                                <Link class="text-decoration-none text-white" :href="'/unfollow/' + tb.id" method="post"
                                    preserve-scroll>Following</Link>
                            </button>
                            <button v-else class="btn btn-sm text-light" style="background-color:#fc5185">
                                <Link class="text-decoration-none text-white" :href="'/follow/' + tb.id" method="post"
                                    preserve-scroll>Follow</Link>
                            </button>
                        </div>
                    </div>
                    <a href="" class="mx-4" style="color:#000;"><span>See All</span></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link,usePage } from '@inertiajs/vue3'
import {computed,onMounted,ref} from 'vue'

    let props=defineProps({topBlogs:Array,topBloggers:Array,blogs:Object,})

    let page=usePage()

    let followings=computed(()=>{
        return page.props.auth.user.followings;
    })

    let isFollowing=(userId)=>{
        // Check if the user with the given ID exists in the followings array
        if (followings.value) {
            return followings.value.some(following => following.id === userId)
        }
    }

    let auth_id=computed(()=>{
        return page.props.auth.user.id
    })


</script>

<style>
    .category-cloud{
        top: 0;
        position: sticky;
        height: 100vh;
        overflow: scroll;
    }

    .category-cloud::-webkit-scrollbar {
        width: 0.1px; /* WebKit */
        /* background-color: #999;  */
    }

    .additionalPart{
        display: none;
    }

</style>