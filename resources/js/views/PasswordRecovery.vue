<template>
    <div class="flex justify-center items-center">
        <div class="max-w-lg max-h-[300px] bg-white/40 rounded-md">
            <BasicAuthenticationInput v-model="formFields.email" name="Email" type="email" :class="allErrors==401? 'border-red-600' : ''" objKey="email"/>
            help
        </div>
    </div>
</template>

<script>
import BasicAuthenticationInput from '../components/BasicAuthenticationInput.vue'

export default {
    name: 'PasswordRecovery',
    components: {
        BasicAuthenticationInput
    },
    created() {
        console.log('i have been created')
    }
}
</script>

<style>

</style>