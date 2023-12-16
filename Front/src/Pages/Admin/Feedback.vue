<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center text-dark">Заявки на обратную связь</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="updateData()">
                            <div class="form-floating" >
                                <textarea style="height: 100px;" class="form-control" v-model="feedback.comment" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Комментарий</label>
                                <div v-if="errorMessage" class="alert alert-danger mt-2" role="alert">
                                    {{ errorMessage }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" style="border-width: thick" type="radio" name="statusRadios" id="activeRadio" value="Active" v-model="feedback.status">
                                    <label class="form-check-label" for="activeRadio">Активно</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" style="border-width: thick"  type="radio" name="statusRadios" id="resolvedRadio" value="Resolved" v-model="feedback.status">
                                    <label class="form-check-label" for="resolvedRadio">Решено</label>
                                </div>
                            </div>
                            <button :disabled="allowToUpdate === false" type="submit" class="btn btn-outline-success">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-striped mt-3">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Сообщение</th>
                        <th>Комментарий</th>
                        <th>Дата создания</th>
                        <th>Дата ответа</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="feedback in result" :key="feedback.id">
                        <td>{{ feedback.id }}</td>
                        <td>{{ feedback.name }}</td>
                        <td>{{ feedback.email }}</td>
                        <td>{{ feedback.message }}</td>
                        <td>{{ feedback.comment }}</td>
                        <td>{{ feedback.created_at }}</td>
                        <td>{{ feedback.updated_at }}</td>
                        <td>
                            <span v-if="feedback.status === 'Resolved'" style="color: #7ffe7f;">✔</span>
                            <span v-else style="color: red;">✘</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-warning" @click="edit(feedback)">Ответить</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="statusFilter">Статус</label>
                    <select v-model="statusFilter" class="form-control" id="statusFilter">
                        <option value="">Все</option>
                        <option value="Active">Активные</option>
                        <option value="Resolved">Решенные</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateFilter">Дата</label>
                    <div class="input-group">
                        <input v-model="start_date" type="date" class="form-control" id="startDateFilter">
                        <div class="input-group-append">
                            <span class="input-group-text">до</span>
                        </div>
                        <input v-model="end_date" type="date" class="form-control" id="endDateFilter">
                    </div>
                </div>
                <div class="form-group col-md-1 mt-4">
                    <button  :disabled="!(statusFilter || start_date)"  @click="applyFilters" class="btn btn-primary btn-block">Применить</button>
                    <br>
                    <br>

                    <button style="width: 109px" @click="getFeedback" class="btn btn-secondary btn-block">Сбросить</button>
                </div>
                <div class="form-group col-md-2 mt-4">

                </div>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            statusFilter: '',
            start_date:'',
            end_date:'',
            filteredFeedback: [],
            API_URL: import.meta.env.VITE_BASE_API_URL,
            isAdmin: null,
            allowToUpdate: false,
            errorMessage: '',
            result: {},
            feedback: {
                id: '',
                status: 'Active',
                email: '',
                comment: '',
                updated_at: new Date().toISOString(),
            },
        };
    },
    created() {
        this.checkAdmin();
    },
    mounted() {
        console.log("mounted() called.......");
        this.getFeedback();
    },
    methods: {

        applyFilters() {
            axios.get(this.API_URL + '/feedback/filter', { params: { status:this.statusFilter ,start_date:this.start_date, end_date:this.end_date ,} })
                .then(({ data }) => {
                    this.result = data.data
                    console.log(this.start_date,this.end_date,this.statusFilter);
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error applying filters:', error);
                });
        },
        getUserId() {
            const user = JSON.parse(localStorage.getItem('userData'));
            if (user) {
                return user[0].id;
            }
        },

        checkAdmin() {
            const user = JSON.parse(localStorage.getItem('userData'));
            if (user) {
                this.isAdmin = user[0].admin === 1 ? 1 : null;
            }
        },
        getFeedback() {
            axios.get(`${this.API_URL}/feedback/get`)
                .then(({ data }) => {
                    console.log(data);
                    this.result = data.data;
                    this.clearFilter()
                })
                .catch(error => {
                    console.error('Error getting feedback:', error);
                });
        },
        edit(feedback) {
            this.feedback = feedback;
            this.allowToUpdate = true;
        },
        updateData() {
            if (this.feedback.comment == null && this.feedback.status === 'Resolved') {
                this.errorMessage = 'Оставьте комментарий чтобы изменить статус!';
                setTimeout(() => {
                    this.errorMessage = '';
                }, 3000);
            } else {
                const editrecords = `${this.API_URL}/feedback/answer/${this.feedback.id}`;
                axios.put(editrecords, this.feedback)
                    .then(({ data }) => {
                        console.log(this.feedback)
                        this.feedback.comment = '';
                        this.feedback.status = 'Active';
                        this.id = '';
                        this.errorMessage = null;
                        console.log(this.feedback);
                        this.getFeedback();
                    })
                    .catch(error => {
                        console.error('Error updating feedback:', error);
                    });
            }
        },
        remove(feedback) {
            const url = `${this.API_URL}/feedback/${feedback.id}`;
            axios.delete(url)
                .then(() => {
                    this.getFeedback();
                })
                .catch(error => {
                    console.error('Error removing feedback:', error);
                });
        },

        clearFilter(){
            this.statusFilter = '';
            this.start_date = '';
            this.end_date = '';
        }
    },
};
</script>

