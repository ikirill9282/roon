
// remember to use module.exports instead of tailwind.config in production
tailwind.config = 
   {
      // Note: config only includes the used styles & variables of your selection
      content: ["./src/**/*.{html,vue,svelte,js,ts,jsx,tsx}"],
      theme: {
        extend: {
          fontFamily: {
            '14-semi-font-family': "Rubik-SemiBold, sans-serif",
'h1-font-family': "Rubik-ExtraBold, sans-serif",
'18-med-font-family': "Rubik-Medium, sans-serif",
'14-reg-font-family': "Rubik-Regular, sans-serif",
'16-reg-font-family': "Rubik-Regular, sans-serif",
          },
          fontSize: {
            '14-semi-font-size': "14px",
'h1-font-size': "32px",
'18-med-font-size': "18px",
'14-reg-font-size': "14px",
'16-reg-font-size': "16px",
          },
          fontWeight: {
            '14-semi-font-weight': "600",
'h1-font-weight': "800",
'18-med-font-weight': "500",
'14-reg-font-weight': "400",
'16-reg-font-weight': "400",
          },
          lineHeight: {
            '14-semi-line-height': "140%",
'h1-line-height': "140%",
'18-med-line-height': "140%",
'14-reg-line-height': "140%",
'16-reg-line-height': "140%", 
          },
          letterSpacing: {
             
          },
          borderRadius: {
              
          },
          colors: {
            'black': '#000000',
'main': '#197adc',
'white': '#ffffff',
'grey': '#595555',
            
          },
          spacing: {
              
          },
          width: {
             
          },
          minWidth: {
             
          },
          maxWidth: {
             
          },
          height: {
             
          },
          minHeight: {
             
          },
          maxHeight: {
             
          }
        }
      }
    }

          