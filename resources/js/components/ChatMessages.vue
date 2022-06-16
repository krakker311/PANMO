// resources/assets/js/components/ChatMessages.vue

<template>

  <ul>
    <li class="left clearfix" v-for="message in messages" :key="message.id">
      <div class="clearfix">
        <div class="header">
          <strong>
            {{ user.id }}
          </strong>
        </div>
        <p>
          {{ message.user_id }}
        </p>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["messages", "user_id"],
};
</script>
