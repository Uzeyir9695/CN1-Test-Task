<template>
    <div class="text-center m-5">
        <h1>Welcome To NC1 Test Task Dashboard</h1>
        <div class="mx-2 center">
            <el-input v-model="name" class="w-50 m-2" style="width: 48%; margin-right: 13px" placeholder="Enter name">
                <template #prefix>
                    <el-icon class="el-input__icon"><search /></el-icon>
                </template>
            </el-input>
            <el-input v-model="price" class="w-50 m-2" style="width: 48%; margin-right: 13px" placeholder="Enter price format: 200-300">
                <template #prefix>
                    <el-icon class="el-input__icon"><search /></el-icon>
                </template>
            </el-input>
            <el-input v-model="bedrooms" class="w-50 m-2" style="width: 48%; margin-right: 13px" placeholder="Enter bedrooms">
                <template #prefix>
                    <el-icon class="el-input__icon"><search /></el-icon>
                </template>
            </el-input>
            <el-input v-model="bathrooms" class="w-50 m-2" style="width: 48%; margin-right: 13px" placeholder="Enter bathrooms">
                <template #prefix>
                    <el-icon class="el-input__icon"><search /></el-icon>
                </template>
            </el-input>
            <el-input v-model="storeys" class="w-50 m-2" style="width: 48%; margin-right: 13px" placeholder="Enter storeys">
                <template #prefix>
                    <el-icon class="el-input__icon"><search /></el-icon>
                </template>
            </el-input>
            <el-input v-model="garages" class="w-50 m-2" style="width: 48%; margin-right: 13px" placeholder="Enter garages">
                <template #prefix>
                    <el-icon class="el-input__icon"><search /></el-icon>
                </template>
            </el-input>
        </div>

        <el-table v-loading="loading" :data="tableData" border style="width: 75%">
            <el-table-column label="Name" prop="name"></el-table-column>
            <el-table-column label="Price" prop="price"></el-table-column>
            <el-table-column label="Bedrooms" prop="bedrooms"></el-table-column>
            <el-table-column label="Bathrooms" prop="bathrooms"></el-table-column>
            <el-table-column label="Storeys" prop="storeys"></el-table-column>
            <el-table-column label="Garages" prop="garages"></el-table-column>
        </el-table>
    </div>
</template>

<script>
import { ElInput, ElIcon, ElTable, ElTableColumn } from "element-plus";
import { Search } from '@element-plus/icons-vue';
import axios from "axios";
export default {
    components: {
        ElInput, ElIcon, ElTable, ElTableColumn, Search
    },
    name: "Booking",
    data() {
        return {
            tableData: [],
            name: '',
            price: '',
            bedrooms: '',
            bathrooms: '',
            storeys: '',
            garages: '',
            loading: false
        };
    },

    created() {
        this.loading = true
        this.getHouses()
        this.loading = false
    },

    methods: {
        getHouses(){
            this.loading = true;
            const queryParams = {
                name: this.name,
                price: this.price,
                bedrooms: this.bedrooms,
                bathrooms: this.bathrooms,
                storeys: this.storeys,
                garages: this.garages
            };
            axios.get('api/houses', {
                params: queryParams
            })
                .then(({data})=> {
                    this.tableData = data.data
                    // This setTimout callback function is just for the illustration of the data loading system
                    setTimeout(() => {
                        this.loading = false;
                    }, 400);
                })
                .catch((error) => {
                    console.log(error)
                    this.loading = false
                })
        }
    },

    watch: {
        name: 'getHouses',
        price: 'getHouses',
        bedrooms: 'getHouses',
        bathrooms: 'getHouses',
        storeys: 'getHouses',
        garages: 'getHouses'
    }

}
</script>
<style scoped>
.text-center {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.center {
    display: flex;
    justify-content: center;
}

.mx-2 {
    margin-bottom: 2rem;
    margin-top: 2rem;
}
</style>
