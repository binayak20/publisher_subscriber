
var datas = [];
datas.push({name:'Dhaka', id:'1',pid:'0'});
datas.push({name:'Khulna', id:'2',pid:'0'});
datas.push({name:'Rajshahi', id:'3',pid:'0'});
datas.push({name:'Mirpur', id:'4',pid:'1'});
datas.push({name:'ASD', id:'5',pid:'1'});
datas.push({name:'D', id:'6',pid:'0'});
datas.push({name:'Gollamari', id:'7',pid:'2'});
datas.push({name:'Sonadanga', id:'8',pid:'2'});
datas.push({name:'Talaimari', id:'9',pid:'3'});
datas.push({name:'Sahaeb Bazar', id:'10',pid:'3'});
datas.push({name:'Zero Point', id:'11',pid:'10'});
datas.push({name:'KU', id:'12',pid:'7'});
datas.push({name:'Stadium', id:'13',pid:'4'});
datas.push({name:'CSE', id:'14',pid:'12'});
datas.push({name:'CSE13', id:'15',pid:'14'});
var tstart = null;

function hasChild(node,name)
{
	var cid = getIdFromName(name);
	for(var i=0;i<datas.length;++i)
	{
		if(datas[i].pid == cid)
		{
			return true;
		}
	}
	return false;
}

function getIdFromName(name)
{
	for(var i=0;i<datas.length;++i)
	{
		if(datas[i].name == name)
		{
			return datas[i].id;
		}
	}
}

function appendAllChild(parent,id)
{
	for(var i=0;i<datas.length;++i)
	{
		if(datas[i].pid == id)
		{
			var chld = createChild(datas[i].name);
			parent.appendChild(chld);
			parent.childNodes[0].innerHTML = '-&nbsp;';
		}
	}
}

function genAllParents()
{
	tstart = document.createElement('div');
	tstart.setAttribute('class','gparent');
	tstart.setAttribute('id','gparent');
	for(var i=0;i<datas.length;i++)
	{
		if(datas[i].pid == 0)
		{
			//console.log("Here");
			var getParent = createParent(datas[i].name);
			//console.log(getParent);
			tstart.appendChild(getParent);
		}
	}
	console.log(tstart);
	document.getElementById('tree').appendChild(tstart);
}

function createChild(name)
{
	var child = document.createElement('div');
	child.setAttribute('class','childs');
	// var icon = document.createElement('div');
	// icon.setAttribute('class','dinline');
	// icon.innerHTML = '&rarr;';
	if(hasChild(child,name))
 	{
 		var sign = createTitle('p','+&nbsp;');
 		sign.setAttribute('id','sign');
 		child.appendChild(sign);
 	}
	//var childnode = document.createElement('div');
	//childnode.setAttribute('class','dinline');
	child.appendChild(createTitle('c',name));
	//child.appendChild(icon);
	//child.appendChild(childnode);
	return child;
}
 function createParent(name)
 {
 	console.log("p");
 	var parent = document.createElement('div');
 	parent.setAttribute('class','parents');
 	if(hasChild(parent,name))
 	{
 		var sign = createTitle('p','+&nbsp;');
 		sign.setAttribute('id','sign');
 		parent.appendChild(sign);
 	}
 	parent.appendChild(createTitle('p',name));
 	console.log(parent);
 	return parent;
 }

 function createTitle(p,name)
 {
 	var title = null;
 	if(p=="c")
 	{
 		title = document.createElement('h3');
 	}
 	else
 	{
 		title = document.createElement('h2');
 	}
 	title.innerHTML = name;
 	title.setAttribute('onclick','onClick(this);');
 	return title;
 }

 function onClick(elm)
 {
 	console.log("all ok");
 	console.log(elm);
 	var pnode = elm.parentNode;
 	console.log(pnode);
 	console.log(pnode.parentNode);
 	console.log(pnode.childElementCount);
 	if(pnode.childElementCount < 3)
 	{
 		var name;
 		if(pnode.childElementCount==1)
 		{
 			name = pnode.childNodes[0].innerHTML;
 		}
 		else
 		{
 				name = pnode.childNodes[1].innerHTML;
 		}
 		var id = getIdFromName(name);
 		appendAllChild(pnode,id);
 	}
 	else
 	{

 		var del =pnode.childNodes[2];
 		while(del)
 		{
 			pnode.removeChild(del);
 			del = pnode.childNodes[2];
 		}
 		pnode.childNodes[0].innerHTML = '+&nbsp;';
 	}
 }
