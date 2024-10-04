<template>
    <div class="flex justify-center gap-4 mb-8">
        <button @click="goToHome" class="bg-blue-500 text-white py-2 px-4 rounded">Home</button>
        <button @click="goToLogin" class="bg-green-500 text-white py-2 px-4 rounded">Login</button>
        <button @click="goToRegister" class="bg-purple-500 text-white py-2 px-4 rounded">Sign In</button>
    </div>
</template>

<script>
export default {
    methods: {
        goToHome() {
            window.location.href = '/';
        },
        goToLogin() {
            window.location.href = '/login';
        },
        goToRegister() {
            window.location.href = '/register';
        }
    }
};
</script>

<style scoped>
button {
    transition: all 0.3s ease;
}
button:hover {
    transform: scale(1.05);
}
</style>
