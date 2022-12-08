import './App.css';
import  { useState } from 'react';
import imageIcon from './image/image.png';

function App() {
  const [code, setCode] = useState('');
  const [firstName, setFirstName] = useState('');
  const [middleName, setMiddleName] = useState('');
  const [lastName, setLastName] = useState('');
  const [department, setDepartment] = useState('');
  const [position, setPosition] = useState('');
  const [email, setEmail] = useState('');
  const [passwordType, setPasswordType] = useState('password');
  const [password, setPassword] = useState('');
  const [image, setImage] = useState({ preview: "", raw: "" });
  const [selectedStatus, setStatus] = useState("");
  const [selectedGender, setGender] = useState("");
  const [formSave, successMessage] = useState('');

  const [required, setRequired] = useState('');

  function changeTypeOfPassword()
  {
    if('password' === passwordType){
      setPasswordType('text');
    }else{
      setPasswordType('password');
    }
  }

  function generate()
  {
    let length = 8;
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let retVal = "";

    for (let i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }

    setPassword(retVal);
  }

  function changePassword(e)
  {
    setPassword(e.target.value);
  }

  function uploadImage(e)
  {
      if(e.target.files.length > 0){
        setImage({
          preview: URL.createObjectURL(e.target.files[0]),
          raw: e.target.files[0]
        });
      }
  }

  function handleChangeStatus(e){
    setStatus( e.target.value);
  }

  function handleGender(e) {
    setGender( e.target.value);
  }

  function handleRequest(e)
  {
      e.preventDefault();

      if('' == code || '' == firstName || '' == department || '' == selectedGender || '' == email || '' == password) {
        setRequired('* missing required field');
        return;
      }

      setRequired('');

      const formData = new FormData();

      formData.append('code',code);
      formData.append('firstName',firstName);
      formData.append('middleName',middleName);
      formData.append('lastName',lastName);
      formData.append('department',department);
      formData.append('gender',selectedGender);
      formData.append('position',position);
      formData.append('email',email);
      formData.append('password',password);
      formData.append('avatar',(image.raw));
      formData.append('status',selectedStatus);

     //Create an object from the form data entries
      let formDataObject = Object.fromEntries(formData.entries());
      // Format the plain form data as JSON
      let formDataJsonString = JSON.stringify({'data':formDataObject});

      fetch("http://localhost:8082/save-details", {
        method: "POST",
        body: formData
      }).then(response => response.json())
      .then(result => {
          console.log('Success:', result);
          setCode('');
          setFirstName('');
          setMiddleName('');
          setLastName('');
          setGender('');
          setDepartment('');
          setPosition('');
          setPassword('');
          setEmail('');
          setStatus('');
          setImage({
            preview: '',
            raw: ''
          });

          successMessage('Form Submitted Successfully!');
          setTimeout(() => {successMessage('')}, 3000);
      }).catch(
         (error) => {
            alert(error);
         }
      );

  }

  return (
    <div className="App">
      <form  onSubmit={handleRequest}>
        <h3>Add New Employee</h3>
        <hr/>
        <div>
          <input type="submit" value="submit" />
        </div>
        <hr/>
        {formSave ? <h2>{formSave}</h2> : ''}
        <div id="employee-code">
            <label>Employee Code : </label>
            <input type="text" placeholder="enter code" value={code} onChange={(e) => setCode(e.target.value)}></input>
            {'' == code ? <span className='required-field'><br/>{required}</span> : '' }
        </div>
        <br></br>
        <div id="employee-name" className="flex-container">
          <div  className="flex-item" >
            <label>First Name : </label>
              <input type="text" 
                placeholder="enter first name"
                value={firstName}
                onChange={(e) => setFirstName(e.target.value)}
                style={{marginRight : "10px"}}
                >    
              </input>
              {'' == firstName ? <span className='required-field'><br/>{required}</span> : '' }
          </div>
          <div  className="flex-item" >
            <label>Middle Name : </label>
              <input type="text"
                placeholder="enter middle name"
                value={middleName}
                onChange={(e) => setMiddleName(e.target.value)}
                style={{marginRight : "10px"}}
              >
              </input>
          </div>
          <div  className="flex-item" >
            <label>Last Name : </label>
            <input type="text" 
              placeholder="enter lasr name"
              value={lastName}
               onChange={(e) => setLastName(e.target.value)}>
            </input>  
          </div>
        </div>
        <br></br>
        <div id="employee-designation" className="flex-container">
            <div className="flex-item" >
              <label>Gender : </label>
              <select  value={selectedGender} onChange={handleGender} style={{marginRight : "10px"}}>
                <option value=""></option>
                <option value='male'>Male</option>
                <option value='female'>Female</option>
                <option value='other'>Other</option>
              </select>
              {'' == selectedGender ? <span className='required-field'><br/>{required}</span> : '' }
            </div>
            <div className="flex-item" >
              <label>Department : </label>
              <input type="text" 
                placeholder="enter department"
                value={department}
                onChange={(e) => setDepartment(e.target.value)}
                style={{marginRight : "10px"}}
                >    
              </input>
              {'' == department ? <span className='required-field'><br/>{required}</span> : '' }
            </div>
            <div className="flex-item" >
              <label>Position : </label>
              <input type="text" 
                placeholder="enter position"
                value={position}
                onChange={(e) => setPosition(e.target.value)}
                style={{marginRight : "10px"}}
                >    
              </input>
            </div>
        </div>
        <br></br>
        <div id="email">
            <label>Email : </label>
            <input type="email" 
              placeholder="enter email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              style={{marginRight : "10px"}}
              >    
            </input>
            {'' == email ? <span className='required-field'><br/>{required}</span> : '' }
        </div>
        <br></br>
        <div id="password">
            <label>Password : </label>
            <input type={passwordType} 
              maxLength="8"
              placeholder="enter code"
              value={password}
              onChange={changePassword}
              style={{marginRight : "10px"}}
              >    
            </input>
            <input type="checkbox" onChange={changeTypeOfPassword} style={{marginRight : "14px"}}/>
            <input type="button" value="Generate" onClick={generate}></input>
            {'' == password ? <span className='required-field'><br/>{required}</span> : '' }
        </div>
        <br></br>
        <div id="avatar">
              <label>Avatar : </label>
              <input type="file" onChange={uploadImage}></input>
              <br></br>
              <div style={{marginLeft:'5%', marginTop: '2%'}}>
              {image.preview ? <img src= {image.preview} id="image-icon" alt="dummy" width="150" height="150"/> : <img src={imageIcon} />}
              </div>
        </div>
        <br></br>
        <div id="employee-status">
          <label>Status: </label>
          <select value={selectedStatus} onChange={handleChangeStatus}>
            <option value=""></option>
            <option value="active">Active</option>
            <option value="inactive">InActive</option>
          </select> 
        </div>
      </form>
    </div>
  );
}

export default App;
