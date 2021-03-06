<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script src="/Public/vue.js"></script>
</head>
<body>

<div id="app1">
{{message}}
</div>

<div id="app2">
	<span v-bind:title="message">
		鼠标悬停几秒钟查看此处动态绑定的提示信息！
	</span>
</div>

<div id="app3">
	<p v-if="seen">你看的到我吗！</p>
</div>

<div id="app4">
	<ol>
		<li v-for="todo in todos">
			{{todo.text}}
		</li>
	</ol>
</div>

<div id="app5">
	<p>{{message}}</p>
	<button v-on:click="isLike">点我有惊喜</button>
</div>

<div id="app6">
	<p>{{message}}</p>
	<input v-model="message"/>
</div>

<div id="app7">
	<ol>
		<todo-item
			v-for="todo in todos"
			v-bind:todo="item"
			v-bind:key="item.id"
		>
		</todo-item>
	</ol>
</div>

<div id="app8">
	<p v-bind:style="obj">哈哈</p>
</div>

<div id="app9">
	<p v-bind:class="[activeClass1,activeClass2]">哟呵</p>
</div>

<div id="todo-list">
	<input
	v-model="newTodoText"
	v-on:keyup.enter="addNewTodo"
	placeholder="新增数据"
	>
	<ul>
		<li
		is="todo-item"
		v-for="(todo,index) in todos"
		v-bind:id="todo.id"
		v-bind:title="todo.title"
		v-on:remove="todos.splice(index,1)"
		></li>
	</ul>
</div>

<script>
/** 文本插入 **/
var app = new Vue({
	el:"#app1",
	data:{
		message:'Hello world vue!'
	}
});

/** 绑定DOM元素属性  v-bind **/
var app2 = new Vue({
	el:"#app2",
	data:{
		message: '页面加载于 ' + new Date().toLocaleString()
	}
});

/** 条件循环 v-if **/
var app3 = new Vue({
	el:"#app3",
	data:{
		seen:true//false隐藏
	}
});

/** 绑定数组的数据来渲染一个项目列表  v-for **/
var app4 = new Vue({
	el:"#app4",
	data:{
		todos:[
		    {text:'好好学习'},
		    {text:'天天向上'},
		    {text:'哎呀哟！'}
		]
	}
});

app4.todos.push({text:'新追加进来的一条数据'});

/** 绑定事件监听  v-on **/
var app5 = new Vue({
	el:"#app5",
	data:{
		message:'这是什么鬼！'
	},
	methods:{
		isLike:function(){
			this.message = this.message.split('').reverse().join('')
		}
	}
});

/** 表单输入和应用状态之间的双向绑定 v-model **/
var app6 = new Vue({
	el:"#app6",
	data:{
		message:'输入消息试试'
	}
});

/** 将数据从父作用域传到子组件  **/
Vue.component('todo-item', {
  // item-todo 组件现在接受一个
  // "prop"，类似于一个自定义属性
  // 这个属性名为 todo。
  props: ['todo'],
  template: '<li>{{ todo.text }}</li>'
})

var app7 = new Vue({
	el:"#app7",
	data:{
		todos:[
			{id:0, text:'苹果'},
			{id:1, text:'西瓜'},
			{id:2, text:'草莓'}
		]
	}
});

/** style的绑定 对象语法案例**/
var app8 = new Vue({
	el:"#app8",
	data:{
		obj:{
			color:'red',
			fontSize:'25px'
		}
	}
});

/** class的绑定  数组语法案例**/
var app9 = new Vue({
	el:"#app9",
	data:{
		activeClass1:"active",
		activeClass2:"red"
	}
});

/** todo-list的完整应用 **/
//接收一个组件 todo-item  自定义一个属性 "props"  属性名为 title
Vue.component('todo-item', {
	template: '<li>{{ title }}<button v-on:click="$emit(\'remove\')">X</button></li>',
	props: ['title']
})
var app10 = new Vue({
	el:"#todo-list",
	data:{
		newTodoText:'',
		todos:[
			{
				id:1,
				title:'第一列'
			},
			{
				id:2,
				title:'第二列'
			},
			{
				id:3,
				title:'第三列'
			}
		],
		nextTodoId:4
	},
	methods:{
		addNewTodo:function(){
			this.todos.push({
				id:this.nextTodoId++,
				title:this.newTodoText
			});
			this.newTodoText = ''
		}
	}
});
</script>

</body>
</html>