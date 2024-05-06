const {createApp} = Vue;
createApp({
    data() {
      return {
        toDo: [],
        apiUrl: 'server.php',
        text : ''
      }
    },
    methods : {
      toggleDone(id){
        const item = this.toDo.find((el) => el.id === id);
        if (item){
          item.done = !item.done;
        }
      },
      removeItem(id){
        const i = this.toDo.findIndex((el) => el.id === id)
        this.toDo.splice(i,1)
      },
      addNewLi(text){
        let newId = 0
        this.toDo.forEach(el => {
          if (el.id > newId) {
            newId = el.id
          }
          newId = newId + 1;
        });
        let newLi = {
          id: newId,
          text,
          done : false        
      };
      // console.log(newId);
      this.toDo.push(newLi);
      this.text = ''       
      },
      getData (){
        axios
        .get(this.apiUrl)
        .then((response) => {
          console.log(response.data);
          this.toDo = response.data
        })
      }
    },
    created () {
     this.getData()
    },
    mounted () {      
    }
  }).mount('#app');