/**
 
 * FAQs And Product Questions
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    FAQs And Product Questions
 * @author     Asif Hussain <support@fmeextensions.com>
 * 	       
 * @copyright  Copyright 2012 © www.fmeextensions.com All right reserved
 *
 

/*global document, Prototype, Ajax, Class, Event, $, $A, $F, $R, $break, Control */

if(typeof(Prototype) == "undefined") {
    throw "Control.Like requires Prototype to be loaded."; }
if(typeof(Object.Event) == "undefined") {
    throw "Control.Like requires Object.Event to be loaded."; }

Control.Like = Class.create({
    
    initialize: function(container,like_element,like_result,likeby_text,count_elements,options){
        
        Control.Like.instances.push(this);
        
        this.likeby_name = false;
        this.likeby_id = false; 
        this.liked_obj_id = false; // the id of the like item (testimonial)
        this.likeby_avatar = false;
        this.avatar_img = false;
        this.container = $(container);
        this.like_element = $(like_element);
        this.like_result = $(like_result);
        this.likeby_text = $(likeby_text);
        this.count_elements = $(count_elements);
        
        
        this.options = {
                
            classNames: {
                like_on: 'like_on',
                like_off: 'like_off'
            },
            updateUrl: false,
            updateParameterName: 'value',
            updateOptions : {},
            afterChange: Prototype.emptyFunction
        };
        
        
        Object.extend(this.options,options || {});
        
        if(this.options.likeby_name){
            this.likeby_name = this.options.likeby_name;
            delete this.options.likeby_name;
        }
        
           
        if(this.options.likeby_id){
            this.likeby_id = this.options.likeby_id;
            delete this.options.likeby_id;
        }
        
        if(this.options.liked_obj_id){
            this.liked_obj_id = this.options.liked_obj_id;
            delete this.options.liked_obj_id;
        }
        
        if(this.options.likeby_avatar){
            this.likeby_avatar = this.options.likeby_avatar;
            this.avatar_img = "<img src='"+this.likeby_avatar+"' width='16px' height='16px;' style='margin-right:5px; margin-left:5px;'>";
            delete this.options.likeby_avatar;
        }
        
        this.startLike(this.container,this.options.classNames,this.likeby_name,this.likeby_id,this.liked_obj_id,this.avatar_img);
        //this.showMiniprofile(this.like_result,this.likeby_name,this.avatar_img);
        
    },
    
    
    
    startLike: function(container,classNames,likebyName,likebyId,likeobjId,avatar_img){
        
        var likeBtn = this.like_element;
        var like_result = this.like_result;
           
        likeBtn.observe('click',function(event){
                
                //Create the likeby info
                    if(like_result.empty()){
                        
                            if(!like_result.hasClassName(classNames.like_off) && !like_result.hasClassName(classNames.like_on)){
                                
                                like_result.addClassName(classNames.like_on);
                                this.setValue(likebyName,likebyId,likeobjId,'add');
                                Element.update.delay(0.1,likeBtn,'Liking ...');
                                Element.update.delay(1.5,likeBtn,'Unlike');
                                Element.update.delay(1.5,like_result,''+avatar_img+'You');
                                if(this.likeby_text.empty()){
                                    Element.update.delay(1.5,this.likeby_text,'Liked by'); //this.likeby_text.innerHTML = 'Liked by';
                                }
                                
                                
                            }else
                            if(like_result.hasClassName(classNames.like_off)){
                                
                                like_result.removeClassName(classNames.like_off);
                                like_result.addClassName(classNames.like_on);                     
                                this.setValue(likebyName,likebyId,likeobjId,'add');
                                Element.update.delay(0.1,likeBtn,'Liking ...');
                                Element.update.delay(1.5,likeBtn,'Unlike');
                                Element.update.delay(1.5,like_result,''+avatar_img+'You');
                                if(this.likeby_text.empty()){
                                   Element.update.delay(1.5,this.likeby_text,'Liked by'); //this.likeby_text.innerHTML = 'Liked by';
                                }
                                
                                
                            }
                        

                    }else
                    if(!like_result.empty()){
                        
                            if(like_result.hasClassName(classNames.like_on)){
                                
                                like_result.removeClassName(classNames.like_on);
                                like_result.addClassName(classNames.like_off);
                                this.setValue(likebyName,likebyId,likeobjId,'delete');
                                Element.update.delay(0.1,likeBtn,'Unliking ...');
                                Element.update.delay(1.5,likeBtn,'Like');
                                Element.update.delay(1.5,like_result,'');
                                if(!this.likeby_text.empty() && this.count_elements.title==0 || this.count_elements.innerHTML==1){
                                    Element.update.delay(1.5,this.likeby_text,'');//this.likeby_text.innerHTML = '';
                                }
                                
                            }else
                            if(like_result.hasClassName(classNames.like_off)){
                                
                                like_result.removeClassName(classNames.like_off);
                                like_result.addClassName(classNames.like_on);                     
                                this.setValue(likebyName,likebyId,likeobjId,'add');
                                Element.update.delay(0.1,likeBtn,'Liking ...');
                                Element.update.delay(1.5,likeBtn,'Unlike');
                                Element.update.delay(1.5,like_result,''+avatar_img+'You');
                                
                            }
                        
                    }
                    
                    
                
                     
                    
            }.bindAsEventListener(this));
            
        
        
        
    },
    
        
    setValue: function(likeby_name,likeby_id,likeobjId,add_delete){
        
            if(this.options.updateUrl){
                var params = {}, a;
                params['likeby_username'] = likeby_name;
                params['likeby_id'] = likeby_id;
                params['like_object_id'] = likeobjId;
                params['act'] = add_delete;
                
                a = new Ajax.Request(this.options.updateUrl, Object.extend(
                    this.options.updateOptions, { parameters : params }
                ));
            }
            
        
    },
    
    showMiniprofile:function(like_res,likeby_name,thumb_img){
        
        
            
            like_res.observe('click',function(event){

                       
                var prof = $(document.createElement('div'));            
                prof.addClassName('testimonial-mini-profile');        
                prof.innerHTML = likeby_name;
                like_res.appendChild(prof);
                
                });
       
        
        
    }
    
    
    
    
    
    
});

Object.extend(Control.Like,{
    instances: [],
    findByElementId: function(id){
        return Control.Like.instances.find(function(instance){
            return (instance.container.id && instance.container.id == id);
        });
    }
});
Object.Event.extend(Control.Like);
