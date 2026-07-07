fetch('https://t-system-modern.onrender.com/sample020.php?r=' + Math.random())
  .then(r => r.text())
  .then(t => {
      console.log('Includes layout_settings.js?', t.includes('layout_settings.js'));
      console.log('Includes msc-settings-panel?', t.includes('msc-settings-panel'));
      console.log('Includes original setting div?', t.includes('id ="setting" class="setting"'));
      
      const s1 = t.indexOf('<div class="questionbuttonbox" id="questionbuttonbox"');
      if (s1 !== -1) console.log('QBox:', t.substring(s1, s1+100));
  });
