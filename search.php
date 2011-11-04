<!DOCTYPE html>
<?php include "header.php"; ?>
      	      		    <div data-role="content">
						<h3>Search for songs</h3>
						
								<form action="updatePlaylist.php" method="get">
												<label for="name">Enter a song title:</label>
												       			       <input type="search" name="songtitle" id="search" value=""  />
															       	      		    		     		 <button data-icon="search" type="submit" name="search" value="search-value">Search</button>
																						 	 		    		  </form>
																											     <h3>Browse songs by genre</h3>
																											     		      	 <div data-role="collapsible-set">
																														         <div data-role="collapsible">
																															          <h3>Top 40</h3>
																																  	      <ul data-role="listview" data-split-icon="plus" data-inset="true">
																																	      	  		       			         <li>
																																								        <a href="#">
																																									          <h3>Song Title 1</h3>
																																										  	   	       <p>Song Artist 1</p>
																																												       	       	           </a>
																																															          <a href="#"></a>
																																																          </li>
																																																	        <li>
																																																		       <a href="#">
																																																		       	         <h3>Song Title 2</h3>
																																																				 	  	      <p>Song Artist 2</p>
																																																						      	      	          </a>
																																																									         <a href="#"></a>
																																																										         </li>
																																																											       <li>
																																																											              <a href="#">
																																																												      	        <h3>Song Title 3</h3>
																																																															             <p>Song Artist 3</p>
																																																																     	     	         </a>
																																																																			        <a href="#"></a>
																																																																				        </li>
																																																																					     </ul>
																																																																					         </div>
																																																																						     <div data-role="collapsible">
																																																																						     	      <h3>Trance</h3>
																																																																							           <ul data-role="listview" data-split-icon="plus" data-inset="true">
																																																																								       			    			      <li>
																																																																														             <a href="#">
																																																																															     	       <h3>Song Title 1</h3>
																																																																																       		            <p>Song Artist 1</p>
																																																																																			    	    	        </a>
																																																																																						       <a href="#"></a>
																																																																																						       	       </li>
																																																																																							             <li>
																																																																																								            <a href="#">
																																																																																									              <h3>Song Title 2</h3>
																																																																																										      	       	           <p>Song Artist 2</p>
																																																																																													   	   	       </a>
																																																																																															              <a href="#"></a>
																																																																																																      	      </li>
																																																																																																	            <li>
																																																																																																		           <a href="#">
																																																																																																			             <h3>Song Title 3</h3>
																																																																																																				     	      	          <p>Song Artist 3</p>
																																																																																																							  	  	      </a>
																																																																																																									             <a href="#"></a>
																																																																																																										     	     </li>
																																																																																																											          </ul>
																																																																																																												      </div>
																																																																																																												          <div data-role="collapsible">
																																																																																																													           <h3>Rock</h3>
																																																																																																														        <ul data-role="listview" data-split-icon="plus" data-inset="true">
																																																																																																															    			 			   <li>
																																																																																																																					          <a href="#">
																																																																																																																						            <h3>Song Title 1</h3>
																																																																																																																							    	     	         <p>Song Artist 1</p>
																																																																																																																										 	 	     </a>
																																																																																																																												            <a href="#"></a>
																																																																																																																													            </li>
																																																																																																																														          <li>
																																																																																																																															         <a href="#">
																																																																																																																																           <h3>Song Title 2</h3>
																																																																																																																																	   	    	        <p>Song Artist 2</p>
																																																																																																																																					            </a>
																																																																																																																																						           <a href="#"></a>
																																																																																																																																							           </li>
																																																																																																																																								         <li>
																																																																																																																																									        <a href="#">
																																																																																																																																										          <h3>Song Title 3</h3>
																																																																																																																																											  	   	       <p>Song Artist 3</p>
																																																																																																																																													       	       	           </a>
																																																																																																																																																          <a href="#"></a>
																																																																																																																																																	          </li>
																																																																																																																																																		       </ul>
																																																																																																																																																		           </div>
																																																																																																																																																			       <div data-role="collapsible">
																																																																																																																																																			       	        <h3>Rap</h3>
																																																																																																																																																					     <ul data-role="listview" data-split-icon="plus" data-inset="true">
																																																																																																																																																					     	 		      			        <li>
																																																																																																																																																												       <a href="#">
																																																																																																																																																												       	         <h3>Song Title 1</h3>
																																																																																																																																																														 	  	      <p>Song Artist 1</p>
																																																																																																																																																																      	      	          </a>
																																																																																																																																																																			         <a href="#"></a>
																																																																																																																																																																				         </li>
																																																																																																																																																																					       <li>
																																																																																																																																																																					              <a href="#">
																																																																																																																																																																						      	        <h3>Song Title 2</h3>
																																																																																																																																																																									             <p>Song Artist 2</p>
																																																																																																																																																																										     	     	         </a>
																																																																																																																																																																													        <a href="#"></a>
																																																																																																																																																																														        </li>
																																																																																																																																																																															      <li>
																																																																																																																																																																															             <a href="#">
																																																																																																																																																																																     	       <h3>Song Title 3</h3>
																																																																																																																																																																																	       		            <p>Song Artist 3</p>
																																																																																																																																																																																				    	    	        </a>
																																																																																																																																																																																							       <a href="#"></a>
																																																																																																																																																																																							       	       </li>
																																																																																																																																																																																								            </ul>
																																																																																																																																																																																									        </div>
																																																																																																																																																																																										   </div>
																																																																																																																																																																																										     </div>
																																																																																																																																																																																										       <!-- FOOTER -->
																																																																																																																																																																																										       	    	   <?php include "footer.php"; ?>
