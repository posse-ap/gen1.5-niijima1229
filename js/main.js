(function() {
  'use strict'
  const app = {
    data() {
      return {
        newItem: '',
        todos: []
      }
    },
    watch: {
      todos: {
        handler: function() {
          console.log('aa')
          localStorage.setItem('todos', JSON.stringify(this.todos));
        },
        deep: true
      }
    },
    mounted: function() {
      this.todos = JSON.parse(localStorage.getItem('todos')) || [];
    },
    methods: {
      addItem: function() {
        this.todos.push({title: this.newItem, isDone: false});
        this.newItem = '';
      },
      deleteItem: function(index) {
        if (confirm('are you sure?')) {
          this.todos.splice(index, 1);
        }
      },
      purge: function() {
        if (!confirm('delete finished?')) {
          return;
        }
        this.todos = this.remaining;
      }
    },
    computed: {
      remaining: function() {
        return this.todos.filter(function(todo) {
          return !todo.isDone;
        })
      }
    }
  }

  Vue.createApp(app).mount('#app')
})()