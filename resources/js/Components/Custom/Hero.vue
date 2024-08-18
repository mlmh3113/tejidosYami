<template>
    <div class="w-full h-96 overflow-hidden relative">

        <img class="w-full h-full object-cover hover:scale-110 duration-500 overflow-y-hidden "
            src="../../../../public/images/lana-3.png" alt="hero_image">

        <div class="flex items-center -translate-x-1/2 md:translate-x-0 ml-10 w-full md:flex-row absolute md:top-1/2 left-2/3 top-1/2 -mt-5 md:left-2/4 -translate-y-1/2  text-2xl md:text-3xl text-white font-bold">
            <p class="text-gray-800 dark:text-white">Tejidos echos con</p>

            <p class="flex justify-center items-center align-middle heart">
                <svg class="w-12 h-12 text-red-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                </svg>
            </p>


        </div>



        <!-- class="flex ml-10 -mt-5 w-full md:flex-row absolute top-1/2 left-2/3 -translate-x-1/2 -translate-y-1/2 text-3xl text-white font-bold" -->


    </div>


</template>

<script setup>

</script>

<style scoped >

.heart {
    @apply animate-pulse;
}

@keyframes pulse {
    50% {
        transform: scale(1.2);
    }
}

</style>
