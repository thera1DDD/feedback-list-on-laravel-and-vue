<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center text-dark mt-2">Список дел</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card-body">
                    <form @submit.prevent="save">
                        <div class="form-floating mb-3">
                            <input  class="form-control" v-model="todo.case" id="floatingInput" placeholder="Занятие">
                            <label for="floatingInput">Занятие</label>
                        </div>
                        <div class="form-floating">
                            <textarea  style="height: 100px;" class="form-control" v-model="todo.description" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Описание</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1" v-model="todo.is_completed" :checked="todo.is_completed === 1">
                            <label class="form-check-label" for="exampleRadios1">
                                Готово
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios"  id="exampleRadios2" value="0" v-model="todo.is_completed" :checked="todo.is_completed !== 1">
                            <label class="form-check-label" for="exampleRadios2">
                                Не готово
                            </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-outline-success">Сохранить</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
<!--                <h2>Список дел</h2>-->
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Занятие</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <br>
                    <tbody>
                    <tr v-for="todo in result" v-bind:key="todo.id">
                        <td>{{ todo.id }}</td>
                        <td>{{ todo.case }}</td>
                        <td>{{ todo.description }}</td>
                        <span v-if="todo.is_completed === 1" style="color: #7ffe7f;">✔</span>
                        <span v-else style="color: red;">✘</span>
                        <td>
                            <button type="button" class="btn btn-outline-warning"  @click="edit(todo)">Редактировать</button>
                            <button type="button" class="btn btn-danger"  style="width: 134px" @click.prevent="remove(todo)">Удалить</button>
                        </td>
                    </tr>

                    </tbody>
                </table>
<!--                <table class="table table-dark">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th scope="col">ID</th>-->
<!--                        <th scope="col">Todo Name</th>-->
<!--                        <th scope="col">Address</th>-->
<!--                        <th scope="col">Phone</th>-->
<!--                        <th scope="col">Option</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr v-for="todo in result" v-bind:key="todo.id">-->
<!--                        <td>{{ todo.id }}</td>-->
<!--                        <td>{{ todo.case }}</td>-->
<!--                        <td>{{ todo.description }}</td>-->
<!--                        <td>{{ todo.is_completed }}</td>-->
<!--                        <td>-->
<!--                            <button type="button" class="btn btn-warning" @click="edit(todo)">Edit</button>-->
<!--                            <button type="button" class="btn btn-danger"  @click="remove(todo)">Delete</button>-->
<!--                        </td>-->
<!--                    </tr>-->

<!--                    </tbody>-->
<!--                </table>-->
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    case: 'Todo',
    data () {
        return {
            isAdmin:null,
            result: {},
            todo:{
                id: '',
                case: '',
                description: '',
                is_completed: 0,
                users_id:this.getUserId()
            }
        }
    },
    created() {
        this.checkAdmin()
        this.TodoLoad();
    },
    mounted() {

        console.log("mounted() called.......");
    },

    methods: {
        getUserId(){
            const user =JSON.parse(localStorage.getItem('userData'))
            if(user){
                return user[0].id
            }
        },

        checkAdmin(){
            const user =JSON.parse(localStorage.getItem('userData'))
            if(user){
                if(user[0].admin === 1){
                    return this.isAdmin = 1
                }
                else{
                    return this.isAdmin = null
                }
            }
        },
        TodoLoad()
        {
            let page;

            if(this.isAdmin === 1){
               page = "http://127.0.0.1:8000/api/todo";
                console.log(this.isAdmin);
            }
            else {
               page = `http://127.0.0.1:8000/api/todo/${this.getUserId()}`;
            }
            axios.get(page)
                .then(
                    ({data})=>{
                        console.log(data);
                        this.result = data;
                }
            );
        },

        save()
        {
            if(this.todo.id === '')
            {
                this.saveData();
            }
            else
            {
                this.updateData();
            }

        },
       async saveData()
        {
          await this.axios.post("http://127.0.0.1:8000/api/todo", {
              case: this.todo.case,
              description:this.todo.description,
              is_completed:this.todo.is_completed,
              users_id:this.getUserId()})
                .then(
                    ({data})=>{
                        this.TodoLoad();
                        this.todo.case = ''
                        this.todo.description = ''
                        this.todo.is_completed = ''
                        this.id = ''
                    }
                )
        },
        edit(todo)
        {
            this.todo = todo;
        },
        updateData()
        {
            const editrecords = 'http://127.0.0.1:8000/api/todo/' + this.todo.id;
            axios.put(editrecords, this.todo)
                .then(
                    ({data})=>{
                        this.todo.case = '';
                        this.todo.description = '',
                            this.todo.is_completed = ''
                        this.id = ''
                        this.TodoLoad();
                    }
                );

        },

        remove(todo){
            var url = `http://127.0.0.1:8000/api/todo/${todo.id}`;
            // var url = 'http://127.0.0.1:8000/api/todo/'+ todo.id;
            axios.delete(url);
            this.TodoLoad();
        }
    }
}
</script>
