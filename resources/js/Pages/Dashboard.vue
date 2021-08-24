<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-0 md:p-4 lg:p-6">
                    <h1 class="pl-3 font-extrabold tracking-wide text-3xl lg:text-5xl text-green-500">Login Temperatures</h1>
                    
                    <hr class="my-4">
                    
                    <div class="w-full overflow-hidden flex flex-row-reverse my-4">
                        <button class="bg-blue-500 font-bold py-2 px-4 ml-4 hover:bg-blue-700" @click="reset">Reset Order</button>
                        <button class="bg-pink-500 font-bold py-2 px-4 ml-4 hover:bg-pink-700" @click="hottestFirst">Hottest First</button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div v-for="(items, city) in data" :key="city" class="">
                            <h2 class="font-bold tracking-wide text-2xl lg:text-3xl pl-3">{{ city }}</h2>
                            <table class="mt-4">
                                <tr v-for="item in items" :key="item.id">
                                    <td class="p-3 mr-2">{{ item.formatted_date }}</td>
                                    <td class="p-3 mr-2">{{ item.celsius }}°C</td>
                                    <td class="p-3 mr-2">{{ item.fahrenheit }}°F</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default {
        components: {
            AppLayout,
        },
        props: {
            data: Object,
        },
        methods: {
            hottestFirst() {
                this.$inertia.get(this.route('dashboard'), { hottest: true }, { replace: true, preserveState: true, preserveScroll: true });
            },
            reset() {
                this.$inertia.get(route('dashboard'));
            }
        }
    }
</script>
