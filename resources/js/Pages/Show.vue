<template>
  <div class="">
    <Navbar></Navbar>
    <div class="container">
      <div class="row align-items-center justify-content-center" style="position: relative; top: 50px;">
        <div class="col-11 col-md-8 col-lg-6 mt-5">
          <div class="mb-3">
            <h1 class="fw-bold">{{ blog.title }}</h1>
          </div>

          <!-- writer-profile-img,name&date -->
          <div class="">
            <div class="d-flex align-items-start">
              <div class="me-2">
                  <div v-if="!blog.user.profile_picture" style="width: 35px; height: 35px; border-radius: 50%;" class="bg-dark text-white d-flex justify-content-center align-items-center ">
                      <h5 class="mb-0">{{ blog.user.name.slice(0, 1) }}</h5>
                  </div>
                  <img v-else class="user-profile-img"
                      :src="'/storage/'+blog.user.profile_picture"
                      alt="">
              </div>
              <div class="me-2">
                <div class="d-flex">
                  <span class="me-2">{{ author }}</span>
                  <div v-if="auth_id != blog.user_id">
                    <Link v-if="isFollowing(blog.user_id)" :href="'/unfollow/' + blog.user_id" method="post"
                        preserve-scroll class="text-decoration-none text-dark fw-bold">. Following</Link>
                    <Link v-else :href="'/follow/' + blog.user_id" method="post" preserve-scroll
                        class="text-decoration-none text-dark fw-bold">. Follow</Link>
                  </div>
                </div>
                <p class="text-black-50 mb-0 ">{{ formatDate(blog.created_at) }}</p>
              </div>
            </div>
          </div>
          <!-- Feature-photo and body -->
          <div class="my-4">
            <img class="w-100 h-auto mb-4" :src="getImageUrl(blog.feature_photo)" alt="">
            <p class="">{{ blog.body }}</p>
          </div>
        </div>

        <!-- Comments -->
        <div class="col-12 mt-2">
          <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6">
              <div class="d-flex align-items-center mb-4">
                <h4 class="me-2 mb-1">Comments</h4>
                <i class="bi bi-caret-down-fill" v-if="hasComments" @click="toggleComment"></i>
                <i class="bi bi-caret-right-fill" v-if="!hasComments" @click="toggleComment"></i>
              </div>

              <div v-if="hasComments">
                <div v-for="c in comments" :key="c.id" class="my-1">
                  <div class="mb-1 d-flex align-items-center">
                    <div class="me-2">
                        <div v-if="!c.user.profile_picture" style="width: 35px; height: 35px; border-radius: 50%;" class="bg-dark text-white d-flex justify-content-center align-items-center ">
                            <h5 class="mb-0">{{ c.user.name.slice(0, 1) }}</h5>
                        </div>
                        <img v-else class="user-profile-img"
                            :src="'/storage/'+c.user.profile_picture"
                            alt="">
                    </div>
                    <div class="me-2">
                      <div class="d-flex">
                        <span class="me-2">{{ c.user.name }}</span>
                        <div v-if="auth_id != c.user.id">
                          <Link v-if="isFollowing(c.user_id)" :href="'/unfollow/' + c.user_id" method="post"
                              preserve-scroll class="text-decoration-none text-dark fw-bold">. Following</Link>
                          <Link v-else :href="'/follow/' + c.user_id" method="post" preserve-scroll
                              class="text-decoration-none text-dark fw-bold">. Follow</Link>
                        </div>
                      </div>
                      <p class="text-black-50 mb-0 ">{{ formatDate(c.created_at) }}</p>
                    </div>
                  </div>
                  <p class="">{{ c.body }}</p>
                  <hr class="text-black-50">
                </div>
              </div>

            </div>
          </div>

          <!-- Write Comment -->
          <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6 mb-5">
              <form method="post" @submit.prevent="writeComment">
                <div class="d-flex align-items-end">
                  <textarea placeholder="Write a comment..." v-model="form.body" class="form-control me-1"
                    rows="5"></textarea>
                  <button class="btn" style="background-color:#fc5185"><i
                      class="bi bi-send-fill h5 text-white"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <BotNav @hasAdditionalPart="hasAdditionalPart"/>

    <!-- Profile Part -->
    <ProfilePart/>

  </div>
</template>
  
<script setup>
import Navbar from '../components/Navbar.vue'
import ProfilePart from '../components/ProfilePart.vue'
import BotNav from '../components/BotNav.vue';
import { ref,onMounted,onUnmounted,computed } from 'vue'
import { useForm,usePage,Link } from '@inertiajs/vue3';

let props = defineProps({ blog: Object, author: String, comments: Object });
let page=usePage()

let trackViewerTimeOut;
  onMounted(() => {
    trackViewerTimeOut=setTimeout(trackViewer, 5000);
  });

  onUnmounted(()=>{
    clearTimeout(trackViewerTimeOut);
  })

let trackViewer = () => {
  console.log("tracking viewer...");
  form.post('/viewer',{
    preserveScroll: true,
  });
}

let hasComments = ref(true);

let formatDate = (value) => {
  return new Date(value).toLocaleDateString()
};

let getImageUrl = (featurePhoto) => {
  return `/storage/feature_images/${featurePhoto}`;
};

let toggleComment = () => {
  console.log('Toggle Comment Clicked');
  hasComments.value = !hasComments.value;
};

let form = useForm({
  body: '',
  blog_id: props.blog.id,
});

let writeComment = () => {
  form.post('/comment', {
    preserveScroll: true
  });
  form.body = '';
}

let auth_id=computed(()=>{
  return page.props.auth.user.id
})

let followings=computed(()=>{
  return page.props.auth.user.followings;
})

let isFollowing=(userId)=>{
  // Check if the user with the given ID exists in the followings array
  if (followings.value) {
      return followings.value.some(following => following.id === userId)
  }
}

</script>
  
<style></style>