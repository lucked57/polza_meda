const EventHandling = {
  data() {
    return {
      message: "text",
     
    }
  },
  methods: {
    
  },
    mounted(){
     
      console.log(Vue.version);
      /*console.log(axios); 
      axios.get("https://jsonplaceholder.typicode.com/todos/1")
      .then(response => console.log("Axios works:", response.data))
      .catch(error => console.error("Axios error:", error));*/
      
    
  }
}

Vue.createApp(EventHandling).mount('#app');
